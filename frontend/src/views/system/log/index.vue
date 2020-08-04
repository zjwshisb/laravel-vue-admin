<script>
import { getSystemLog, getSystemLogContent, deleteSystemLog } from '../../../api/system'
export default {
  name: 'index',
  data () {
    return {
      dir: [],
      content: [],
      query: {
        page: 1,
        size: 200
      },
      key: '',
      loadingMore: false,
      hasMore: true,
      loading: false,
      dirLoading: false
    }
  },
  created () {
    this.handleGetFile()
  },
  methods: {
    handleReset () {
      this.query.page = 1
      this.content = []
      this.loadingMore = false
      this.hasMore = true
    },
    handleGetFile () {
      this.dirLoading = true
      getSystemLog().then(res => {
        this.dirLoading = false
        this.dir = res
      })
    },
    getContent (path) {
      this.key = path[0]
      this.loading = true
      this.handleGetContent(true).then(() => {
        this.loading = false
      })
    },
    handleGetContent (reset = false) {
      if (reset === true) {
        this.handleReset()
      }
      return getSystemLogContent({
        path: this.key,
        page: this.query.page,
        size: this.query.size
      }).then(res => {
        if (res.code === 0) {
          this.content = this.content.concat(res.data)
          if (res.data.length < this.query.size) {
            this.hasMore = false
          }
        } else {
          this.$message.error(res.message)
        }
        return Promise.resolve(res)
      })
    },
    handleLoadMore () {
      this.query.page++
      this.loadingMore = true
      this.handleGetContent().then(res => {
        this.loadingMore = false
      })
    },
    handleDelete () {
      this.$confirm({
        title: '提示',
        content: '确定删除该日志?',
        onOk: () => {
          deleteSystemLog(this.key).then(res => {
            if (res.code === 0) {
              this.$message.success('删除成功')
              this.handleGetFile()
              this.handleReset()
              this.key = ''
            } else {
              this.$message.error(res.message)
            }
          })
        }
      })
    }
  },
  render () {
    const format = files => {
      return files.map(file => {
        if (file.children) {
          return (<a-tree-node key={file.path} title={file.name} selectable={false}>
            {format(file.children)}
          </a-tree-node>)
        } else {
          return <a-tree-node key={file.path} title={file.name} is-leaf/>
        }
      })
    }
    const loadMore = (
      <div slot="loadMore"
        style={{ textAlign: 'center', marginTop: '12px', height: '32px', lineHeight: '32px' }}
      >
        {this.loadingMore ? (<a-spin spinning={true}/>) : (<a-button onclick={this.handleLoadMore}>加载更多</a-button>)}

      </div>
    )
    return (
      <div>
        <a-row gutter={10}>
          <a-col span={6}>
            <a-card title="文件" style="margin-top: 60px;overflow: hidden;">
              <a-spin spinning={this.dirLoading}>
                <a-directory-tree default-expand-all onselect={this.getContent}>
                  {format(this.dir)}
                </a-directory-tree>
              </a-spin>
              <a slot="extra" onclick={this.handleGetFile}>刷新</a>
            </a-card>
          </a-col>
          <a-col span={18}>
            <a-page-header title={this.key.substr(1)}>
              <template slot="extra">
                <a-button type="danger" v-pid={14100} disabled={this.key === ''} onclick={this.handleDelete}>删除</a-button>
              </template>
              <a-list bordered class="log-list" split={false} loading={this.loading}>
                {this.content.map(v => {
                  return (<a-list-item size="small">{v}</a-list-item>)
                })}
                {(this.content.length > 0 && this.hasMore) ? loadMore : ''}
              </a-list>
            </a-page-header>
          </a-col>
        </a-row>
      </div>)
  }
}
</script>

<style scoped lang="less">
.ant-card-body{
  padding: 5px;
}
.log-list{
  padding: 10px;
}
.ant-list-item{
  padding: 0;
  border-bottom: 0;
}
</style>

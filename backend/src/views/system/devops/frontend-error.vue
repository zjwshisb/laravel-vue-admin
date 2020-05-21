<template>
  <div>
    <div class="filter-container">
      <a-button v-pid="13110" type="danger" icon="delete" @click="handleFlush">清空</a-button>
    </div>
    <a-table :data-source="list" :columns="columns" bordered rowKey="id" :pagination="pagination"
             :loading="loading.table" :scroll="{x: $store.getters.isMobile}"
             @change="handleChange">
    </a-table>
  </div>
</template>

<script>
import { fetchFrontendError, flushFrontendError } from '../../../api/system'
import Pagination from '@/mixins/pagination'
export default {
  name: 'FrontendError',
  mixins: [Pagination],
  data () {
    return {
      list: [],
      loading: {
        table: false
      },
      query: {

      },
      columns: [
        {
          title: '时间',
          dataIndex: 'created_at',
          align: 'center',
          width: 200
        },
        {
          title: '错误信息',
          dataIndex: 'message',
          align: 'center',
          width: 200
        },
        {
          title: '堆栈',
          dataIndex: 'stack',
          align: 'center'
        },
        {
          title: 'vue信息',
          dataIndex: 'info',
          align: 'center',
          width: 200
        }
      ]
    }
  },
  methods: {
    handleFlush () {
      this.$confirm({
        title: '确定清空所有错误信息?',
        onOk: () => {
          flushFrontendError().then(res => {
            this.$message.success('操作成功')
            this.getData()
          })
        }
      })
    },
    handleChange (pagination) {
      this.pagination = pagination
      this.getData()
    },
    getData (reset = false) {
      if (reset === true) {
        this.pagination.current = 1
      }
      this.loading.table = true
      fetchFrontendError(Object.assign(this.query, {
        page: this.pagination.current,
        size: this.pagination.pageSize
      })).then(res => {
        this.loading.table = false
        this.list = res.data
        this.pagination.total = res.meta.total
      })
    }
  },
  created () {
    this.getData()
  }
}
</script>

<style scoped>
</style>

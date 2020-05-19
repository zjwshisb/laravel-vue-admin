<template>
  <div>
    <div class="filter-container">
      <search-form>
        <a-row :gutter="12">
          <search-form-col>
            <a-form-item label="用户名">
              <a-input placeholder="请输入用户名" v-model="query.username"></a-input>
            </a-form-item>
          </search-form-col>
          <search-form-col>
            <a-form-item>
              <a-button icon="search" @click="getAdminList">查询</a-button>
              <a-button v-pid="11100" type="primary" icon="plus" @click="$router.push({name: 'SystemAccountAdd'})">新增</a-button>
            </a-form-item>
          </search-form-col>
        </a-row>
      </search-form>
    </div>
    <a-table :data-source="list" :columns="columns" bordered rowKey="id" :pagination="pagination"
             :loading="loading.table"
             @change="handleChange">
      <template slot="action" slot-scope="row">
        <div class="table-action">
          <a-button v-pid="11200"  icon="edit" type="primary" size="small" @click="() => $router.push(`/system/account/${row.id}/edit`)">编辑</a-button>
          <a-button v-pid=""  icon="delete" type="danger" size="small">删除</a-button>
        </div>
      </template>
    </a-table>
  </div>
</template>

<script>
import { fetchAdmins } from '../../../api/system'
import pagination from '../../../mixins/pagination'
export default {
  name: 'index',
  mixins: [pagination],
  data () {
    return {
      loading: {
        table: false
      },
      list: [],
      columns: [
        {
          title: '用户名',
          dataIndex: 'username',
          align: 'center'
        },
        {
          title: '权限组',
          dataIndex: 'roles',
          align: 'center'
        },
        {
          title: '创建时间',
          dataIndex: 'created_at',
          align: 'center'
        },
        {
          title: '操作',
          align: 'center',
          scopedSlots: { customRender: 'action' }
        }
      ],
      query: {
        username: ''
      }
    }
  },
  methods: {
    handleChange (e) {
      console.log(e)
    },
    getAdminList () {
      this.loading.table = true
      fetchAdmins(
        Object.assign(this.query, {
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
    this.getAdminList()
  }
}
</script>

<style scoped>

</style>

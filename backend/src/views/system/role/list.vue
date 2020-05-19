<template>
  <div>
    <div class="filter-container">
      <search-form>
        <a-row :gutter="12">
          <search-form-col>
            <a-form-item>
              <a-button v-pid="12100" type="primary" icon="plus" @click="$router.push({name: 'SystemRoleAdd'})">新增</a-button>
            </a-form-item>
          </search-form-col>
        </a-row>
      </search-form>
    </div>
    <a-table :data-source="list" :columns="columns" bordered rowKey="id" :pagination="pagination"
             :loading="loading.table" @change="tableChange">
      <template slot="action" slot-scope="row">
        <div class="table-action">
          <a-button v-pid="12200" icon="edit" type="primary" size="small" @click="() => $router.push(`/system/role/${row.id}/edit`)">编辑</a-button>
          <a-button v-pid="12300" icon="delete" type="danger" size="small" @click="handleDelete(row.id)">删除</a-button>
        </div>
      </template>
    </a-table>

  </div>

</template>

<script>
import pagination from '../../../mixins/pagination'
import { fetchRoles, deleteRole } from '../../../api/system'
export default {
  name: 'list',
  mixins: [pagination],
  data () {
    return {
      loading: {
        table: true
      },
      list: [],
      columns: [
        {
          title: '角色名称',
          dataIndex: 'name',
          align: 'center'
        },
        {
          title: '说明',
          dataIndex: 'description',
          align: 'center'
        },
        {
          title: '创建时间',
          dataIndex: 'created_at',
          align: 'center',
          width: '300px'
        },
        {
          title: '更新时间',
          dataIndex: 'updated_at',
          align: 'center',
          width: '300px'
        },
        {
          title: '操作',
          align: 'center',
          width: '400px',
          scopedSlots: { customRender: 'action' }
        }
      ]
    }
  },
  methods: {
    tableChange (e) {
      this.pagination = e
      this.handleGetRoles()
    },
    handleDelete (id) {
      this.$confirm({
        title: '确定删除该角色?',
        onOk: () => {
          deleteRole(id).then(res => {
            this.$message.success('删除成功')
            this.handleGetRoles()
          })
        }
      })
    },
    handleGetRoles () {
      this.loading.table = true
      fetchRoles({
        page: this.pagination.current,
        size: this.pagination.pageSize
      }).then(res => {
        this.list = res.data
        this.pagination.total = res.meta.total
        this.loading.table = false
      }).catch(() => {
        this.loading.table = false
      })
    }
  },
  created () {
    this.handleGetRoles()
  }
}
</script>

<style scoped>

</style>

<template>
  <div>
    <div class="filter-container">
      <search-form>
        <a-row :gutter="12">
          <search-form-col>
            <a-form-item label="操作人">
              <a-input placeholder="操作人" v-model="query.admin" allowClear></a-input>
            </a-form-item>
          </search-form-col>
          <search-form-col>
            <a-form-item label="操作">
              <a-input placeholder="操作" v-model="query.name" allowClear></a-input>
            </a-form-item>
          </search-form-col>
          <search-form-col>
            <a-form-item>
              <a-button icon="search" @click="getData(true)">查询</a-button>
            </a-form-item>
          </search-form-col>
        </a-row>
      </search-form>
    </div>
    <a-table :data-source="list" :columns="columns" bordered rowKey="id" :pagination="pagination"
             :loading="loading.table" :scroll="{x: $store.getters.isMobile}"
             @change="handleChange">
      <template slot="params" slot-scope="text">
        {{text}}
      </template>
      <template slot="route_params" slot-scope="text">
        {{text}}
      </template>
    </a-table>
  </div>

</template>

<script>
import { fetchAdminActionLogs } from '../../../api/system'
import Pagination from '@/mixins/pagination'
export default {
  name: 'action-log',
  mixins: [Pagination],
  data () {
    return {
      list: [],
      query: {
        admin: '',
        name: ''
      },
      loading: {
        table: false
      },
      columns: [
        {
          title: '操作人',
          dataIndex: 'admin_name',
          align: 'center'
        },
        {
          title: '操作',
          dataIndex: 'name',
          align: 'center'
        },
        {
          title: 'ip',
          dataIndex: 'ip',
          align: 'center'
        },
        {
          title: '操作时间',
          dataIndex: 'created_at',
          align: 'center'
        }
      ]
    }
  },
  methods: {
    handleChange (pagination) {
      this.pagination = pagination
      this.getData()
    },
    getData (reset = false) {
      if (reset === true) {
        this.pagination.current = 1
      }
      this.loading.table = true
      fetchAdminActionLogs(Object.assign(this.query, {
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

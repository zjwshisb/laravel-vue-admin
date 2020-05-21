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
            <a-form-item label="请求方法">
              <a-select v-model="query.method" allowClear>
                <a-select-option :value="x" v-for="x in methods" :key="x">
                  {{x}}
                </a-select-option>
              </a-select>
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
        method: ''
      },
      loading: {
        table: false
      },
      methods: [
        'get', 'post', 'delete', 'put'
      ],
      columns: [
        {
          title: '操作人',
          dataIndex: 'admin_name',
          align: 'center'
        },
        {
          title: '请求方法',
          dataIndex: 'method',
          align: 'center'
        },
        {
          title: '路由',
          dataIndex: 'action',
          align: 'center'
        },
        {
          title: '请求参数',
          dataIndex: 'params',
          align: 'center',
          scopedSlots: { customRender: 'params' }
        },
        {
          title: '路由参数',
          dataIndex: 'route_params',
          align: 'center',
          scopedSlots: { customRender: 'route_params' }
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

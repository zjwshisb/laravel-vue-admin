<template>
  <div>
    <div class="filter-container">
      <search-form>
        <a-row :gutter="12">
          <search-form-col>
            <a-form-item label="name">
              <a-input v-model="query.name" placeholder="name" />
            </a-form-item>
          </search-form-col>
        </a-row>
      </search-form>

    </div>
    <a-table
      :data-source="filterData"
      :columns="columns"
      bordered
      row-key="index"
      :pagination="false"
      :loading="loading.table"
      :scroll="{x: $store.getters.isMobile}"
      class="w-100"
    />
  </div>
</template>

<script>
import { fetchRoute } from '../../../api/system'
export default {
  name: 'FrontendError',
  data () {
    return {
      list: [],
      loading: {
        table: false
      },
      query: {
        name: ''
      },
      columns: [
        {
          title: '#',
          align: 'center',
          customRender (text, record, index) {
            return index + 1
          },
          width: '60px'
        },
        {
          title: 'name',
          align: 'center',
          dataIndex: 'as',
          width: '200px'
        },
        {
          title: 'uri',
          align: 'center',
          dataIndex: 'uri',
          ellipsis: true
        },
        {
          title: 'methods',
          align: 'center',
          dataIndex: 'methods',
          customRender (text, record, index) {
            return text.join(',')
          },
          filters: [
            { text: 'GET', value: 'GET' },
            { text: 'POST', value: 'POST' },
            { text: 'PUT', value: 'PUT' },
            { text: 'DELETE', value: 'DELETE' },
            { text: 'PATCH', value: 'PATCH' }
          ],
          width: '100px',
          onFilter: (value, record) => record.methods.includes(value)
        },
        {
          title: 'controller',
          align: 'center',
          dataIndex: 'controller',
          ellipsis: true
        },
        {
          title: 'middleware',
          align: 'center',
          dataIndex: 'middleware',
          customRender (text, record, index) {
            return text.join(',')
          },
          ellipsis: true
        }
      ]
    }
  },
  computed: {
    filterData () {
      if (this.query.name) {
        return this.list.filter(v => {
          return v.as && v.as.indexOf(this.query.name) > -1
        })
      }
      return this.list
    }
  },
  created () {
    this.getData()
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
      fetchRoute().then(res => {
        this.loading.table = false
        for (const index in res) {
          this.list.push(Object.assign(res[index], { index: index }))
        }
        this.list = res
      })
    }
  }
}
</script>

<style scoped>
</style>

<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="query.name" class="filter-item w-200" size="medium" placeholder="管理员姓名"></el-input>
      <el-button  class="filter-item" size="medium" icon="el-icon-search" @click="fetchList(true)">搜索</el-button>
    </div>
    <el-table :data="data" border stripe v-loading="visible.listLoading">
      <el-table-column label="#" width="100px">
        <template slot-scope="scope">
          {{query.size * (query.page-1) + scope.$index + 1}}
        </template>
      </el-table-column>
      <el-table-column prop="admin_name" label="操作人" align="center">
      </el-table-column>
      <el-table-column prop="action_ip" label="ip" align="center">
      </el-table-column>
      <el-table-column prop="route" label="路由" align="center">
      </el-table-column>
      <el-table-column label="请求参数" align="center">
        <template slot-scope="scope">
          {{JSON.stringify(scope.row.params)}}
        </template>
      </el-table-column>
      <el-table-column prop="created_at" label="请求时间" align="center">
      </el-table-column>
    </el-table>
    <div class="pagination-container">
      <el-pagination
        @size-change="handleSizeChange"
        @current-change="handleCurrentChange"
        :current-page="query.page"
        :page-sizes="[10, 20, 30, 50]"
        :page-size="query.size"
        layout="total, sizes, prev, pager, next, jumper"
        :total="total">
      </el-pagination>
    </div>
  </div>
</template>

<script>
  import { fetchAdminLog } from '@/api/system'
  import Paginate from '@/mixins/paginate'
  export default {
    name: 'admin-log',
    mixins: [Paginate],
    data() {
      return {
        query: {
          name: ''
        },
        visible: {
          listLoading: false
        },
        data: []
      }
    },
    methods: {
      fetchList(reset = false) {
        if (reset) {
          this.query.page = 1
        }
        this.visible.listLoading = true
        fetchAdminLog(this.query).then(res => {
          this.data = res.data
          this.total = res.meta.total
          this.visible.listLoading = false
        }).catch(() => {})
      }
    },
    async created() {
      this.fetchList()
    }
  }
</script>

<style scoped>

</style>

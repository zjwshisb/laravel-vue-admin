<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="query.name" class="filter-item w-200" size="medium" placeholder="权限名"></el-input>
      <el-button  class="filter-item"  icon="el-icon-search" @click="fetchList">搜索</el-button>
      <el-button type="primary" class="filter-item"  icon="el-icon-plus" >新增</el-button>
    </div>
  </div>
</template>

<script>
  import { fetchRoles, addRole, editRole } from '@/api/system'
  export default {
    name: 'role',
    data() {
      return {
        query: {
          name: ''
        }
      }
    },
    methods: {
      fetchList() {
        fetchRoles().then(res => {

        })
      }
    },
    created() {
      this.fetchList()
    }
  }
</script>

<style scoped>

</style>
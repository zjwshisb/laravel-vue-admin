<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="query.name" class="filter-item w-200" size="medium" placeholder="权限名"></el-input>
      <el-button  class="filter-item"  icon="el-icon-search" @click="fetchList">搜索</el-button>
      <el-button type="primary" class="filter-item"  icon="el-icon-plus" @click="showAdd()">新增</el-button>
    </div>
    <el-table :data="roles" border stripe v-loading="visible.listLoading">
      <el-table-column label="#" width="100px">
        <template slot-scope="scope">
          {{query.size * (query.page-1) + scope.$index + 1}}
        </template>
      </el-table-column>
      <el-table-column prop="name" label="名称" align="center">
      </el-table-column>
      <el-table-column prop="description" label="说明" align="center">
      </el-table-column>
      <el-table-column prop="created_at" label="创建时间" align="center">
      </el-table-column>
      <el-table-column label="操作" align="center">
        <template slot-scope="scope">
          <el-button size="mini" icon="el-icon-edit" type="primary">
            编辑
          </el-button>
        </template>
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
    <el-dialog :title="formTitle" :visible.sync="visible.form" width="800px" @close="$refs['form'].resetFields()">
      <el-form :model="form" label-width="100px" ref="form" >
        <el-form-item label="名称" prop="name" verify  required>
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="说明" prop="description" verify required>
          <el-input v-model="form.description"></el-input>
        </el-form-item>
        <el-form-item :label="key" prop="permissions" v-for="group,key in permissions" style="margin-bottom: 0px" :key="key">
          <el-checkbox-group v-model="form.permissions" >
            <el-checkbox v-for="per in group" :label="per.id" :key="per.id">{{per.description}}</el-checkbox>
          </el-checkbox-group>
        </el-form-item>
      </el-form>
      <div slot="footer" class="dialog-footer">
        <el-button @click="visible.form = false">取 消</el-button>
        <el-button type="primary"  @click="handleForm" :loading="visible.formLoading">确 定</el-button>
      </div>
    </el-dialog>
  </div>
</template>

<script>
  import { fetchRoles, addRole, editRole } from '@/api/system'
  export default {
    name: 'role',
    data() {
      return {
        query: {
          name: '',
          size: 10,
          page: 1
        },
        total: 0,
        visible: {
          form: false,
          formLoading: false,
          listLoading: false
        },
        formType: 'add',
        formTitle: '新增角色',
        form: {
          name: '',
          description: '',
          permissions: []
        },
        roles: [],
        permissions: {}
      }
    },
    methods: {
      handleSizeChange(size) {
        this.query.size = size
        this.fetchList()
      },
      handleCurrentChange(page) {
        this.query.page = page
        this.fetchList()
      },
      handleForm() {
        this.$refs.form.validate().then(valid => {
          if (valid) {
            this.visible.formLoading = true
            if (this.formType === 'add') {
              addRole(this.form).then(res => {
                if (res.status === 1) {
                  this.fetchList()
                  this.visible.form = false
                } else {
                  this.$message.error(res.msg)
                }
                this.visible.formLoading = false
              })
            }
          }
        }).catch(() => {})
      },
      showAdd() {
        this.visible.form = true
        this.formType = 'add'
        this.formTitle = '新增角色'
      },
      fetchList() {
        this.visible.listLoading = true
        fetchRoles(this.query).then(res => {
          this.roles = res.roles.data
          this.total = res.roles.total
          this.permissions = res.permissions
          this.visible.listLoading = false
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
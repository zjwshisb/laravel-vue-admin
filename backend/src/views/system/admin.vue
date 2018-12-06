<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="query.name" class="filter-item w-200" size="medium" placeholder="用户名"></el-input>
      <el-button  class="filter-item"  icon="el-icon-search" @click="fetchList">搜索</el-button>
      <el-button type="primary" v-permission="'admins.store'" class="filter-item"  icon="el-icon-plus" @click="showAdd()">新增</el-button>
    </div>
    <el-table :data="admins" border stripe v-loading="visible.listLoading">
      <el-table-column label="#" width="100px">
        <template slot-scope="scope">
          {{query.size * (query.page-1) + scope.$index + 1}}
        </template>
      </el-table-column>
      <el-table-column prop="username" label="账号" align="center">
      </el-table-column>
      <el-table-column  label="状态" align="center">
        <template slot-scope="scope">
          {{scope.row.status === 1 ? '启用':'禁用'}}
        </template>
      </el-table-column>
      <el-table-column label="权限组" align="center">
        <template slot-scope="scope">
          {{rolesToString(scope.row.roles)}}
        </template>
      </el-table-column>
      <el-table-column prop="last_login_time" label="最后登陆时间" align="center">
      </el-table-column>
      <el-table-column prop="created_at" label="创建时间" align="center">
      </el-table-column>
      <el-table-column label="操作" align="center">
        <template slot-scope="scope">
          <el-button size="mini" icon="el-icon-edit" type="primary" @click="showEdit(scope.row)" v-permission="'admins.update'">
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
    <el-dialog :title="formTitle" :visible.sync="visible.form" width="600px" @close="$refs['form'].resetFields()">
      <el-form :model="form" label-width="100px" ref="form" >
        <el-form-item label="账户名" prop="username" verify  required v-if="formType === 'add'">
          <el-input v-model="form.username" />
        </el-form-item>
        <el-form-item label="密码" prop="password" verify  required v-if="formType === 'add'">
          <el-input v-model="form.password"/>
        </el-form-item>
        <el-form-item label="状态" prop="status" verify  required>
          <el-switch
              v-model="form.status"
              active-color="#13ce66"
              inactive-color="#ff4949"
              :active-value="1"
              :inactive-value="0">
          </el-switch>
        </el-form-item>
        <el-form-item label="权限角色" prop="roles">
          <el-select v-model="form.roles" multiple placeholder="请选择" style="width: 100%">
            <el-option
                v-for="role in roles"
                :key="role.id"
                :label="role.name"
                :value="role.id">
            </el-option>
          </el-select>
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
  import { fetchAdmins, addAdmin, editAdmin } from '@/api/system'
  export default {
    name: 'system-admin',
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
        editRow: '',
        form: {
          username: '',
          password: '',
          roles: [],
          status: 0
        },
        admins: [],
        roles: []
      }
    },
    methods: {
      rolesToString(roles) {
        return roles.reduce((carry, role, index) => {
          if (index === 0) {
            return role.name
          }
          return role.name + '，' + carry
        }, '')
      },
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
              addAdmin(this.form).then(res => {
                this.fetchList()
                this.visible.form = false
                this.$message.success('新增成功')
                this.visible.formLoading = false
              }).catch(err => {
                if (err.statusText === 'Not Found') {
                  this.$message.error('管理员不存在')
                  this.fetchList()
                }
                this.visible.formLoading = false
              })
            } else {
              editAdmin(this.form, this.editRow.id).then(res => {
                this.fetchList()
                this.$message.success('编辑成功')
                this.visible.form = false
                this.visible.formLoading = false
              }).catch(err => {
                if (err.statusText === 'Not Found') {
                  this.$message.error('管理员不存在')
                  this.fetchList()
                }
                this.visible.formLoading = false
              })
            }
          }
        }).catch(() => {})
      },
      showEdit(row) {
        Object.existAssign(this.form, row)
        this.editRow = row
        this.form.roles = []
        for (const role of row.roles) {
          this.form.roles.push(role.id)
        }
        this.visible.form = true
        this.formType = 'edit'
        this.formTitle = '编辑管理员'
      },
      showAdd() {
        Object.assign(this.form, this.$options.data().form)
        this.visible.form = true
        this.formType = 'add'
        this.formTitle = '新增管理员'
      },
      fetchList() {
        this.visible.listLoading = true
        fetchAdmins(this.query).then(res => {
          this.admins = res.data
          this.total = res.meta.total
          this.visible.listLoading = false
        })
      }
    },
    created() {
      this.fetchList()
      this.$fetchData(['roles']).then(res => {
        this.roles = res.roles
      })
    }
  }
</script>

<style scoped>

</style>

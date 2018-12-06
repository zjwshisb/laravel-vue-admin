<template>
  <div class="app-container">
    <div class="filter-container">
      <el-input v-model="query.name" class="filter-item w-200" size="medium" placeholder="权限名"></el-input>
      <el-button  class="filter-item"  icon="el-icon-search" @click="fetchList">搜索</el-button>
      <el-button v-permission="'roles.store'" type="primary" class="filter-item"  icon="el-icon-plus" @click="showAdd()">新增</el-button>
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
          <el-button size="mini" icon="el-icon-edit" type="primary" @click="showEdit(scope.row)" v-permission="'roles.update'">
            编辑
          </el-button>
          <el-button size="mini" icon="el-icon-close" type="danger" @click="handleDelete(scope.row.id)" v-permission="'roles.destroy'">
            删除
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
        <el-form-item label="名称" prop="name" >
          <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="说明" prop="description" verify required>
          <el-input v-model="form.description"></el-input>
        </el-form-item>
        <el-form-item label="权限" >
          <el-tree
            :data="menus"
            show-checkbox
            node-key="id"
            ref="tree"
            :default-checked-keys="form.permissions"
            :props="defaultProps">
          </el-tree>
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
  import { fetchRoles, addRole, editRole, deleteRole, fetchMenus } from '@/api/system'
  export default {
    name: 'system-role',
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
          name: '',
          description: '',
          permissions: []
        },
        roles: [],
        menus: [],
        defaultProps: {
          children: 'children',
          label: 'name',
          id: 'id'
        }
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
      handleDelete(id) {
        this.$confirm('是否删除该角色?', '提示', {
          confirmButtonText: '确定',
          cancelButtonText: '取消',
          type: 'warning'
        }).then(() => {
          deleteRole(id).then(role => {
            this.$message.success(`删除<${role.name}>成功`)
            this.fetchList()
          }).catch(res => {
            if (res.statusText === 'Not Found') {
              this.$message.error('角色不存在')
              this.fetchList()
            }
          })
        })
      },
      handleForm() {
        this.$refs.form.validate().then(valid => {
          if (valid) {
            this.visible.formLoading = true
            this.form.permissions = this.$refs.tree.getCheckedKeys()
            if (this.formType === 'add') {
              addRole(this.form).then(res => {
                this.fetchList()
                this.$message.success('新增成功')
                this.visible.form = false
                this.visible.formLoading = false
              }).catch((res) => {
                this.visible.formLoading = false
              })
            } else {
              editRole(this.form, this.editRow.id).then(res => {
                this.fetchList()
                this.$message.success('编辑成功')
                this.visible.form = false
                this.$message.error(res.msg)
                this.visible.formLoading = false
              }).catch(res => {
                if (res.statusText === 'Not Found') {
                  console.log('test')
                  this.$message.error('角色不存在')
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
        this.form.permissions = []
        for (const per of row.permissions) {
          this.form.permissions.push(per.id)
        }
        if (this.$refs.tree !== undefined) {
          this.$refs.tree.setCheckedKeys(this.form.permissions)
        }
        this.visible.form = true
        this.formType = 'edit'
        this.formTitle = '编辑角色'
      },
      showAdd() {
        Object.assign(this.form, this.$options.data().form)
        if (this.$refs.tree !== undefined) {
          this.$refs.tree.setCheckedKeys([])
        }
        this.visible.form = true
        this.formType = 'add'
        this.formTitle = '新增角色'
      },
      fetchList() {
        this.visible.listLoading = true
        fetchRoles(this.query).then(res => {
          this.roles = res.data
          this.total = res.meta.total
          this.visible.listLoading = false
        }).catch(() => {})
      }
    },
    async created() {
      this.fetchList()
      this.menus = (await fetchMenus()).menus
    }
  }
</script>

<style scoped>

</style>

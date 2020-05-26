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
              <a-button icon="search" @click="getAdminList(true)">查询</a-button>
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
          <a-button v-pid="11120"  icon="edit" type="primary" size="small" @click="() => $router.push(`/system/account/${row.id}/edit`)">编辑</a-button>
          <a-button v-pid="11130" icon="lock" type="primary" size="small" @click="handleShowPassword(row.id)">修改密码</a-button>
        </div>
      </template>
    </a-table>
    <a-modal
      title="修改密码"
      :visible="pwdVisible"
      :confirm-loading="loading.confirmLoading"
      @ok="handleSubmitPwd"
      @cancel="handleCancel"
    >
      <a-form-model :model="passwordForm" :rules="rules"  ref="pwdForm">
        <a-form-model-item prop="password" >
          <a-input v-model="passwordForm.password" placeholder="请输入新密码"></a-input>
        </a-form-model-item>
      </a-form-model>
    </a-modal>
  </div>
</template>

<script>
import { fetchAdmins, updateAdminPassword } from '../../../api/system'
import pagination from '../../../mixins/pagination'
import { requireValidator } from '../../../util/validator'
export default {
  name: 'index',
  mixins: [pagination],
  data () {
    return {
      loading: {
        table: false,
        confirmLoading: false
      },
      pwdVisible: false,
      passwordForm: {
        password: '',
        id: ''
      },
      rules: {
        password: [
          requireValidator()
        ]
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
          title: '最后登录时间',
          dataIndex: 'last_login_at',
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
    resetPwdForm () {
      Object.assign(this.passwordForm, this.$options.data().passwordForm)
    },
    handleCancel () {
      this.resetPwdForm()
      this.pwdVisible = false
    },
    handleSubmitPwd () {
      this.$refs.pwdForm.validate().then(() => {
        this.loading.confirmLoading = true
        updateAdminPassword(this.passwordForm.id, this.passwordForm.password).then(res => {
          this.$message.success('修改成功')
          this.loading.confirmLoading = false
          this.pwdVisible = false
          this.resetPwdForm()
        }).catch(() => {
          this.loading.confirmLoading = false
        })
      })
    },
    handleShowPassword (id) {
      this.passwordForm.id = id
      this.pwdVisible = true
    },
    handleChange (e) {
      this.pagination = e
      this.getAdminList()
    },
    getAdminList (reset = false) {
      if (reset === true) {
        this.pagination.current = 1
      }
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

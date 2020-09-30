<template>
    <a-page-header :title="title" @back="$router.back()">
      <a-form-model :model="form" :rules="rules" ref="form" :label-col="simpleForm.labelCol" :wrapper-col="simpleForm.wrapperCol">
        <a-form-model-item prop="username" label="用户名">
          <a-input v-model="form.username" :disabled="isEdit" ></a-input>
        </a-form-model-item>
        <a-form-model-item prop="password" label="密码" v-if="!isEdit">
          <a-input v-model="form.password" ></a-input>
        </a-form-model-item>
        <a-form-model-item prop="roles" label="权限组">
          <a-select
            mode="multiple"
            v-model="form.roles"
            :options="roleOptions"
            allowClear
          />
        </a-form-model-item>
        <a-form-model-item prop="is_forbidden" label="禁用" >
          <a-switch v-model="form.is_forbidden" />
        </a-form-model-item>
        <a-form-model-item :wrapperCol="simpleForm.noLabel.wrapperCol">
          <a-button type="primary" @click="handleSubmit" :loading="loading.submit">提交</a-button>
          <a-button @click="() => $router.back()">取消</a-button>
        </a-form-model-item>
      </a-form-model>
    </a-page-header>
</template>

<script>
import SimpleForm from '@/mixins/simpleForm'
import { requireValidator } from '@/util/validator'
import { addAdmin, updateAdmin, getAdminOption, getAdmin } from '@/api/system'

export default {
  name: 'add',
  mixins: [SimpleForm],
  data () {
    return {
      id: '',
      loading: {
        submit: false
      },
      form: {
        username: '',
        real_name: '',
        password: '',
        roles: [],
        is_forbidden: false
      },
      roles: []
    }
  },
  computed: {
    title () {
      if (this.isEdit) {
        return '编辑'
      } else {
        return '新增'
      }
    },
    isEdit () {
      return this.id !== ''
    },
    rules () {
      if (this.isEdit) {
        return {
          roles: [
            requireValidator()
          ]
        }
      } else {
        return {
          username: [
            requireValidator()
          ],
          password: [
            requireValidator()
          ],
          roles: [
            requireValidator()
          ]
        }
      }
    },
    roleOptions () {
      const roles = []
      for (const x of this.roles) {
        roles.push({
          value: x.id,
          label: x.name
        })
      }
      return roles
    }
  },
  methods: {
    handleSubmit () {
      this.$refs.form.validate().then(() => {
        this.loading.submit = true
        if (!this.isEdit) {
          return addAdmin(this.form).then(res => {
            if (res.code === 0) {
              this.loading.submit = true
              this.$message.success('新增成功')
              this.$router.back()
              this.loading.submit = false
            }
          })
        } else {
          return updateAdmin(this.id, this.form).then(res => {
            if (res.code === 0) {
              this.loading.submit = true
              this.$message.success('编辑成功')
              this.$router.back()
              this.loading.submit = false
            }
          })
        }
      }).catch(() => {
        this.loading.submit = false
      })
    }
  },
  beforeMount () {
    getAdminOption().then(res => {
      this.roles = res
    })
    if (this.$route.params.id) {
      this.id = this.$route.params.id
      getAdmin(this.id).then(res => {
        this.form = res
      })
    }
  }
}
</script>

<style scoped>

</style>

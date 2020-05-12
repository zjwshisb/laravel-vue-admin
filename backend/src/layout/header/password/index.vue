<template>
  <a-modal
    title="修改密码"
    :visible="visible"
    :confirm-loading="confirmLoading"
    @ok="handleOk"
    @cancel="handleCancel"
  >
    <a-form-model ref="form" :model="form" :rules="rules" :label-col="{span: 6}" :wrapper-col="{span: 18}" >
      <a-form-model-item label="旧密码" prop="old_password">
        <a-input v-model="form.old_password" type="password">
          <a-icon slot="prefix" type="lock" />
        </a-input>
      </a-form-model-item>
      <a-form-model-item label="新密码" prop="new_password">
        <a-input v-model="form.new_password" type="password">
          <a-icon slot="prefix" type="lock" />
        </a-input>
      </a-form-model-item>
      <a-form-model-item label="确认新密码" prop="confirm_password">
        <a-input v-model="form.confirm_password" type="password">
          <a-icon slot="prefix" type="lock" />
        </a-input>
      </a-form-model-item>
    </a-form-model>
  </a-modal>
</template>

<script>
import { requireValidator } from '../../../util/validator'
import { changePassword } from '../../../api/user'
export default {
  name: 'index',
  props: {
    visible: {
      required: true,
      type: Boolean
    }
  },
  data () {
    const validatePass1 = (rule, value, callback) => {
      if (value === this.form.old_password) {
        callback(new Error('新密码跟旧密码一样'))
      } else {
        callback()
      }
    }
    const validatePass2 = (rule, value, callback) => {
      if (value !== this.form.new_password) {
        callback(new Error('两次密码输入不一致'))
      } else {
        callback()
      }
    }
    return {
      confirmLoading: false,
      form: {
        old_password: '',
        new_password: '',
        confirm_password: ''
      },
      rules: {
        old_password: [
          requireValidator()
        ],
        new_password: [
          requireValidator(),
          {
            validator: validatePass1,
            trigger: 'change'
          }
        ],
        confirm_password: [
          requireValidator(),
          {
            validator: validatePass2,
            trigger: 'change'
          }
        ]
      }
    }
  },
  methods: {
    handleOk () {
      this.$refs.form.validate().then(() => {
        this.confirmLoading = true
        return changePassword(this.form.old_password, this.form.new_password).then(res => {
          this.confirmLoading = false
          if (res.code === 0) {
            this.$success({
              title: '密码修改成功',
              onOk: () => {
                this.$emit('update:visible', false)
                this.$store.dispatch('frontendLogout').then(() => {
                  window.location.reload()
                })
              }
            })
          } else {
            this.$error({
              title: res.message
            })
          }
        })
      }).catch(() => {
        this.confirmLoading = false
      })
    },
    handleCancel () {
      Object.assign(this.form, this.$options.data().form)
      this.$refs.form.clearValidate()
      this.$emit('update:visible', false)
    }
  }
}
</script>

<style scoped>

</style>

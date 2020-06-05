<template>
  <div class="login-container">
    <div class="login-content">
      <div class="title">
        laravel-vue-admin
      </div>
      <a-form-model ref="form"  :model="form" :rules="rules" layout="horizontal" :label-col="{span:0}" :wrapper-col="{span: 24}"
                    class="login-form">
        <a-form-model-item  prop="username">
          <a-input v-model="form.username" placeholder="请输入账号">
            <a-icon slot="prefix" type="user" />
          </a-input>
        </a-form-model-item>
        <a-form-model-item prop="password">
          <a-input v-model="form.password" placeholder="请输入密码" type="password">
            <a-icon slot="prefix" type="lock" />
          </a-input>
        </a-form-model-item>
        <a-form-model-item>
          <a-button type="primary" block @click="login" :loading="loading">登录</a-button>
        </a-form-model-item>
      </a-form-model>
    </div>
  </div>
</template>

<script>
import { requireValidator } from '../../util/validator'
export default {
  name: 'Index',
  data () {
    return {
      loading: false,
      form: {
        username: 'admin',
        password: 'admin'
      },
      rules: {
        username: [
          requireValidator()
        ],
        password: [
          requireValidator()
        ]
      }
    }
  },
  methods: {
    login () {
      this.$refs.form.validate().then(() => {
        this.loading = true
        this.$store.dispatch('login', this.form).then(res => {
          this.loading = false
          this.$store.dispatch('getUserInfo').then(() => {
            this.$router.push('/system/dashboard').catch(() => {
            })
          })
        }).catch(res => {
          if (res.message) {
            this.$error({
              title: res.message
            })
            this.loading = false
          }
        })
      }).catch(() => {})
    }
  }
}
</script>

<style scoped lang="scss">
.login-container{
  display: flex;
  align-items: center;
  flex-direction: column;
  height: 100%;
  background-color: #d2d6de;
  .login-content{
    .title{
      font-size: 30px;
      padding: 20px;
      text-align: center;
    }
    margin-top: 300px;
    width: 400px;
    height: 400px;
  }
  .login-form{
    background-color: #ffffff;
    width: 100%;
    padding: 20px;
  }
}
</style>

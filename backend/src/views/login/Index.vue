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
            <a-icon slot="prefix" type="password" />
          </a-input>
        </a-form-model-item>
        <a-form-model-item prop="password">
          <a-button type="primary" block @click="login">登录</a-button>
        </a-form-model-item>
      </a-form-model>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Index',
  data () {
    return {
      form: {
        username: 'admin',
        password: 'admin'
      },
      rules: {
        username: [
          {
            required: true, message: '请输入用户名', trigger: 'blur'
          }
        ],
        password: [
          {
            required: true, message: '请输入密码', trigger: 'blur'
          }
        ]
      }
    }
  },
  methods: {
    login () {
      this.$store.dispatch('login').then(res => {
        this.$router.push({ name: 'IndexSystemAdmin' }).catch(() => {
        })
      })
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

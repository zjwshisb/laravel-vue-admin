<template>
  <div>
    <a-form-model :model="form" ref="form" :label-col="{xs:24, sm:24, md:8 }" :wrapper-col="{xs:24, sm:24, md: 8}">
      <a-form-model-item prop="username" label="用户名">
        <a-input v-model="form.username"></a-input>
      </a-form-model-item>
      <a-form-model-item prop="password" label="密码">
        <a-input v-model="form.password" type="password"></a-input>
      </a-form-model-item>
      <a-form-model-item :wrapperCol="{offset: 8}">
        <a-button type="primary">提交</a-button>
        <a-button @click="() => $router.go(-1)">取消</a-button>
      </a-form-model-item>
    </a-form-model>
  </div>
</template>

<script>
import { requireValidator } from '../../../util/validator'
export default {
  name: 'add',
  data () {
    return {
      rules: {
        username: [
          requireValidator()
        ],
        password: [
          requireValidator()
        ]
      },
      id: '',
      form: {
        username: '',
        password: ''
      }
    }
  },
  created (e) {
    if (this.$route.params.id) {
      this.id = this.$route.params.id
    }
  }
}
</script>

<style scoped>

</style>

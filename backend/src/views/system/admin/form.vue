<template>
  <div>
    <a-form-model :model="form" ref="form" :label-col="simpleForm.labelCol" :wrapper-col="simpleForm.wrapperCol">
      <a-form-model-item prop="username" label="用户名">
        <a-input v-model="form.username"></a-input>
      </a-form-model-item>
      <a-form-model-item prop="password" label="密码">
        <a-input v-model="form.password" type="password"></a-input>
      </a-form-model-item>
      <a-form-model-item :wrapperCol="simpleForm.noLabel.wrapperCol">
        <a-button type="primary">提交</a-button>
        <a-button @click="() => $router.go(-1)">取消</a-button>
      </a-form-model-item>
    </a-form-model>
  </div>
</template>

<script>
import SimpleForm from '@/mixins/simpleForm'
import { requireValidator } from '../../../util/validator'
export default {
  name: 'add',
  mixins: [SimpleForm],
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

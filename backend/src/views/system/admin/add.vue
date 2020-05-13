<template>
  <div>
    <a-page-header
      title="新增管理员"
      @back="() => $router.go(-1)"
      class="page-header"
    >
    </a-page-header>
    <a-form-model :model="form" ref="form">
      <a-form-model-item prop="username" label="用户名">
        <a-input v-model="form.username"></a-input>
      </a-form-model-item>
    </a-form-model>
  </div>
</template>

<script>
export default {
  name: 'add',
  data () {
    return {
      form: {
        username: '',
        password: ''
      }
    }
  }
}
</script>

<style scoped>

</style>

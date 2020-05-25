<template>
  <a-result status="403" title="403" sub-title="你没有权限进行此操作">
    <template #extra>
      <a-button type="primary" @click="() => $router.push($store.getters.indexRoute) ">
        返回首页
      </a-button>
    </template>
  </a-result>
</template>
<script>
export default {
  data () {
    return {}
  }
}
</script>

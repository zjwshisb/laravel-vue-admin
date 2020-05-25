<template>
  <a-result status="404" title="404" sub-title="页面不见啦">
    <template #extra>
      <a-button type="primary" @click="() => $router.push($store.getters.indexRoute)">
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

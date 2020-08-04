<template>
  <div class="footer">
    {{title}}
  </div>
</template>

<script>
import setting from '../../settings'
export default {
  name: 'index',
  data () {
    return {
      ...setting
    }
  }
}
</script>

<style scoped>
  .footer{
    text-align: center;
    padding: 20px 0 0 0;
  }
</style>

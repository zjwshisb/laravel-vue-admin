<template>
    <iframe :src="url" class="queue"></iframe>
</template>

<script>
export default {
  name: 'Queue',
  data () {
    return {
      url: process.env.VUE_APP_QUEUE_URL + '?token=' + this.$store.getters.token
    }
  },
  created () {
  }
}
</script>

<style scoped>
.queue{
  width: calc(100% + 20px);
  height: calc(100% + 20px);
  border: none;
  margin: -10px;
}
</style>

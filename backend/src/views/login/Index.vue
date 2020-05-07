<template>
  <div class="haha">
    <a-button @click="login"></a-button>
  </div>
</template>

<script>
export default {
  name: 'Index',
  methods: {
    login () {
      this.$store.dispatch('login').then(res => {
        this.$router.push({ name: 'SystemAdmin' }).catch(err => {
          console.log(err)
        })
      })
    }
  }
}
</script>

<style scoped>

</style>

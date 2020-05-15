<template>
  <a-breadcrumb style="margin: 16px 0;text-align: left">
    <template v-for="b in breadcrumbs" >
      <a-breadcrumb-item v-if="!b.meta.hiddenBreadcrumb" :key="b.name">
        <span v-if="!b.parent">{{b.meta.title}}</span>
        <router-link v-else :to="b.path">{{b.meta.title}}</router-link>
      </a-breadcrumb-item>
    </template>
  </a-breadcrumb>
</template>

<script>
export default {
  name: 'Index',
  data () {
    return {
      breadcrumbs: []
    }
  },
  watch: {
    $route (route) {
      this.getBreadcrumb()
    }
  },
  methods: {
    getBreadcrumb () {
      this.breadcrumbs = this.$route.matched.filter(i => i.meta && i.meta.title && !i.meta.hiddenBreadcrumb)
    }
  },
  created () {
    this.getBreadcrumb()
  }
}

</script>
<style scoped>

</style>

<template>
  <a-layout-header class="header">
    <div class="logo" style="width: 200px;height: 64px;display: inline-block"/>
    <a-menu v-if="modulesCount > 1"
            class="menu"
      theme="dark"
      mode="horizontal"
      :default-selected-keys="[currentModule]"
            @click="moduleChange"
    >
      <a-menu-item :key="key" v-for="(route, key) in syncRoutes">
        {{route.title}}
      </a-menu-item>
    </a-menu>
  </a-layout-header>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'index',
  computed: {
    ...mapGetters(['syncRoutes', 'currentModule']),
    modulesCount () {
      return Object.keys(this.syncRoutes).length
    }
  },
  methods: {
    moduleChange (e) {
      this.$store.commit('UPDATE_MODULE', e.key)
    }
  }
}
</script>

<style scoped>
  .header{
    display: flex;
    padding: 0;
  }
  .menu{
    line-height: 64px;
    text-align: left;
  }
</style>

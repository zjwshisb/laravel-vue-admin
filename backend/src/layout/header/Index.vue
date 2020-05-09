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
    <div class="user">
      <a-dropdown>
        <a-avatar :size="32" icon="user" class="avatar"/>
        <a-menu slot="overlay" @click="menuClick">
          <a-menu-item key="logout">
            登出
          </a-menu-item>
        </a-menu>
      </a-dropdown>
    </div>
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
    },
    menuClick (e) {
      console.log(e)
    }
  }
}
</script>

<style scoped lang="less">
  .header{
    display: flex;
    padding: 0;
  }
  .menu{
    line-height: 64px;
    text-align: left;
  }
  .user{
    flex: 1;
    color: #FFF;
    padding-right: 50px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    .avatar {
      &:hover{
        cursor: pointer;
      }
    }
  }
</style>

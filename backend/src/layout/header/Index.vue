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
      <a-dropdown :trigger="['click']">
        <a-badge count="0">
          <a-avatar :size="32" icon="user" class="avatar"/>
        </a-badge>
        <a-menu slot="overlay" @click="menuClick">
          <a-menu-item key="logout">
            登出
          </a-menu-item>
          <a-menu-item key="password">
            修改密码
          </a-menu-item>
        </a-menu>
      </a-dropdown>
    </div>
    <password-form :visible.sync="changePassword"></password-form>
  </a-layout-header>
</template>

<script>
import { mapGetters } from 'vuex'
import PasswordForm from './password'
export default {
  name: 'index',
  components: {
    PasswordForm
  },
  data () {
    return {
      changePassword: false
    }
  },
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
      if (e.key === 'logout') {
        this.$store.dispatch('frontendLogout').then(() => {
          window.location.reload()
        })
      }
      if (e.key === 'password') {
        this.changePassword = true
      }
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

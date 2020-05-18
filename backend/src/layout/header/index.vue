<template>
  <a-layout-header class="header" theme="light">
    <div class="menu-trigger" @click="() => $store.commit('UPDATE_MENU_STATUS', !$store.getters.menuHidden)"
    v-if="!$store.getters.isMobile">
      <a-icon v-if="!$store.getters.menuHidden" type="menu-fold"/>
      <a-icon v-else type="menu-unfold"/>
    </div>
    <a-menu v-if="modulesCount > 1"
            class="menu"
      mode="horizontal"
      :default-selected-keys="[currentModule]"
            @click="moduleChange"
    >
      <a-menu-item :key="route.key" v-for="route in syncRoutes">
        {{route.title}}
      </a-menu-item>
    </a-menu>
    <div class="user">
      <a-dropdown :trigger="['click']">
        <a-badge count="0">
          <a-avatar :size="32" icon="user" class="avatar"/>
          <span class="name">{{$store.getters.username}}</span>
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
      return this.syncRoutes.length
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
  .menu-trigger{
    height: 100%;
    width: 64px;
    text-align: center;
    font-size: 20px;
    &:hover {
      cursor: pointer;
      color: #1890ff;
    }
  }
  .header{
    display: flex;
    padding: 0;
    margin: 0 -24px 0 -24px;
    background: #FFF;
  }
  .menu{
    line-height: 64px;
    text-align: left;
  }
  .user{
    flex: 1;
    padding-right: 50px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    .avatar {
      &:hover{
        cursor: pointer;
      }
    }
    .name{
      &:hover{
        cursor: pointer;
      }
      margin-left: 5px;
    }
  }
</style>

<template>
  <a-layout-header class="header" theme="light">
    <div class="menu-trigger" @click="() => $store.commit('UPDATE_MENU_STATUS', !$store.getters.menuHidden)"
    v-if="!$store.getters.isMobile">
      <a-icon v-if="!$store.getters.menuHidden" type="menu-fold"/>
      <a-icon v-else type="menu-unfold"/>
    </div>
    <div class="header-menu" v-if="modulesCount > 1">
      <a-menu v-if="!isMobile"
              class="horizontal-menu"
              mode="horizontal"
              :default-selected-keys="[currentModule]"
              @click="moduleChange"
      >
        <a-menu-item :key="route.key" v-for="route in syncRoutes">
          {{route.title}}
        </a-menu-item>
      </a-menu>
      <a-dropdown-button v-else  class="vertical-menu"  :trigger="['click']">
        {{currentModuleTitle}}
        <a-menu slot="overlay" @click="moduleChange">
          <a-menu-item :key="route.key" v-for="route in syncRoutes">
            {{route.title}}
          </a-menu-item>
        </a-menu>
      </a-dropdown-button>
    </div>
    <div class="user">
      <a-icon type="bell" class="icon"></a-icon>
      <a-dropdown :trigger="['click']">
        <a-badge count="0">
          <a-avatar :src="$store.getters.avatar"/>
          <span class="name">{{$store.getters.username}}</span>
        </a-badge>
        <a-menu slot="overlay" @click="menuClick">
          <a-menu-item key="password">
            <a-icon type="lock" />
            修改密码
          </a-menu-item>
          <a-menu-item key="logout" style="border-top: 1px solid #eaeaea">
            <a-icon type="logout" />
            退出登录
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
    ...mapGetters(['syncRoutes', 'currentModule', 'isMobile', 'currentModuleTitle']),
    modulesCount () {
      return this.syncRoutes.length
    }
  },
  methods: {
    moduleChange (e) {
      if (e.key !== this.currentModule) {
        for (const k in this.syncRoutes) {
          if (this.syncRoutes[k].key === e.key) {
            this.$router.push(this.syncRoutes[k].routes[0].children[0])
            break
          }
        }
      }
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
  .header-menu{
    .horizontal-menu{
      line-height: 64px;
      text-align: left;
    }
    .vertical-menu{
      margin-left: 50px;
    }
  }
  .user{
    flex: 1;
    padding-right: 50px;
    display: flex;
    align-items: center;
    justify-content: flex-end;
    .icon{
      font-size: 16px;
      margin-right: 15px;
      &:hover{
        cursor: pointer;
      }
    }
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

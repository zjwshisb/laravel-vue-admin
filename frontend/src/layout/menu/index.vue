<template>
  <a-layout-sider class="left-menu" width="200" v-model="collapsed"  breakpoint="sm" :collapsed-width="collapsedWidth"
   @breakpoint="breakpoint"
   :zeroWidthTriggerStyle="triggerStyle">
    <div class="logo">
      <a-icon type="html5" v-if="collapsed"></a-icon>
      <span v-else>唯绿erp</span>
    </div>
    <template v-for="module in syncRoutes">
      <a-menu mode="inline" @click="go" v-show="module.key === currentModule" :key="module.key"  theme="dark"
              :selectedKeys="selectedKeys">
        <template v-for="(route, index) in module.routes">
          <a-sub-menu v-if="route.children.filter(v => !v.hidden ).length > 1" :key="route.path + index">
                <span slot="title">
                  <a-icon :type="route.meta.icon" v-if="route.meta.icon"/>
                  <span v-if="!collapsed">{{route.meta.title}}
                  </span>
                </span>
            <template v-for="child in route.children">
              <a-menu-item :key="route.path + '/' +child.path" v-if="!child.hidden">
                <a-icon :type="child.meta.icon" v-if="child.meta.icon"/>
                <span>
                    {{child.meta.title}}
                  </span>
              </a-menu-item>
            </template>
          </a-sub-menu>
          <a-menu-item v-if="route.children.filter(v => !v.hidden ).length === 1"
                       :key="route.path + '/' + route.children[0].path"
                       class="sub-menu">
            <a-icon :type="route.meta.icon" v-if="route.meta.icon"/>
            <span>
                    {{route.children[0].meta.title}}
                  </span>
          </a-menu-item>
        </template>
      </a-menu>
    </template>
  </a-layout-sider>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
  name: 'Index',
  data () {
    return {
      triggerStyle: {
        marginTop: '-55px'
      }
    }
  },
  computed: {
    ...mapGetters(['syncRoutes', 'currentModule', 'menuHidden']),
    selectedKeys: {
      get () {
        return this.$store.getters.menuActiveKeys
      }
    },
    collapsed: {
      get () {
        return this.menuHidden
      },
      set (val) {
        this.$store.commit('UPDATE_MENU_STATUS', val)
      }
    },
    collapsedWidth () {
      if (this.$store.getters.isMobile) {
        return 0
      } else {
        return 80
      }
    }
  },
  methods: {
    breakpoint (breakpoint) {
      this.$store.commit('UPDATE_IS_MOBILE', breakpoint)
    },
    go (to) {
      const current = this.$route
      if (current.path !== to.key) {
        this.$router.push(to.key).catch(() => {
        })
      }
    }
  },

  created () {
  }
}
</script>

<style scoped lang="scss">
.logo{
  height: 64px;
  width: 100%;
  line-height: 64px;
  font-size: 20px;
  color: #FFF;
  background: #002140;
  text-align: center;
  font-style: italic
}
</style>

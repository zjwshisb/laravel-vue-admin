<template>
  <a-layout-sider width="200" v-model="collapsed">
    <div class="logo">
      <a-icon type="html5" v-if="collapsed"></a-icon>
      <span v-else>laravel-antdv-admin</span>
    </div>
    <template v-for="module in syncRoutes">
      <a-menu mode="inline" @click="go" v-show="module.key === currentModule" :key="module.key"  theme="dark">
        <template v-for="route in module.routes">
          <a-sub-menu v-if="route.children.filter(v => !v.hidden ).length > 1" :key="route.name">
                <span slot="title">
                  <a-icon :type="route.meta.icon" v-if="route.meta.icon"/>
                  <span v-if="!collapsed">{{route.meta.title}}
                  </span>
                </span>
            <template v-for="child in route.children">
              <a-menu-item :key="child.name" v-if="!child.hidden">
                <a-icon :type="child.meta.icon" v-if="child.meta.icon"/>
                <span>
                    {{child.meta.title}}
                  </span>
              </a-menu-item>
            </template>
          </a-sub-menu>
          <a-menu-item v-if="route.children.filter(v => !v.hidden ).length === 1"
                       :key='route.children[0].name'
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
    }
  },
  computed: {
    ...mapGetters(['syncRoutes', 'currentModule', 'menuHidden']),
    collapsed: {
      get () {
        return this.menuHidden
      },
      set (val) {
        this.$store.commit('UPDATE_MENU_STATUS', val)
      }
    }
  },
  methods: {
    go (to) {
      const current = this.$route
      if (current.name !== to.key) {
        this.$router.push({ name: to.key }).catch(() => {
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

<template>
  <a-layout-sider width="200" v-model="collapsed" collapsible theme="light">
    <template v-for="(route, module) in syncRoutes">
      <a-menu mode="inline" class="left-menu" @click="go" v-show="module === currentModule" :key="module">
        <template v-for="route in route.routes">
          <a-sub-menu v-if="route.children.filter(v => !v.hidden ).length > 1" :key="route.name" class="sub-menu">
                <span slot="title">
                  <a-icon :type="route.meta.icon" v-if="route.meta.icon"/>
                  <span v-if="!collapsed">{{route.meta.title}}
                  </span>
                </span>
            <template v-for="child in route.children">
              <a-menu-item :key="child.redirect ? child.redirect.name : child.name" v-if="!child.hidden">
                <a-icon :type="child.meta.icon" v-if="child.meta.icon"/>
                <span>
                    {{child.meta.title}}
                  </span>
              </a-menu-item>
            </template>
          </a-sub-menu>
          <a-menu-item v-else
                       :key='route.children[0].redirect ? route.children[0].redirect.name: route.children[0].name'
                       class="sub-menu">
            <a-icon :type="route.children[0].meta.icon" v-if="route.children[0].meta.icon"/>
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
      collapsed: false
    }
  },
  methods: {
    go (to) {
      const current = this.$route
      if (current.name !== to.key) {
        this.$router.push({ name: to.key })
      }
    }
  },
  computed: {
    ...mapGetters(['syncRoutes', 'currentModule'])
  },
  created () {
  }
}
</script>

<style scoped lang="scss">
.left-menu{
  height: 100%;
  .sub-menu{
    text-align: left;
  }
}
</style>

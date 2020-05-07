<template>
    <a-layout-sider width="200"  v-model="collapsed" collapsible>
      <a-menu mode="inline" class="left-menu"  @click="go">
        <template v-for="(route, module) in syncRoutes">
          <template v-for="route in route.routes" v-if="module === currentModule">
            <a-sub-menu v-if="route.children.length > 1"  :key="route.name" class="sub-menu">
              <span slot="title">
                <a-icon type="user" />
                <span v-if="!collapsed">{{route.meta.title}}
                </span>
              </span>
                  <a-menu-item v-for="child in route.children" :key="child.name" >
                <span>
                  {{child.meta.title}}
                </span>
                  </a-menu-item>
                </a-sub-menu>
                <a-menu-item v-else :key='route.children[0].name'>
                <span>
                  {{route.children[0].meta.title}}
                </span>
              </a-menu-item>
          </template>
        </template>
      </a-menu>
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
    console.log(this.syncRoutes)
    console.log(this.currentModule)
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

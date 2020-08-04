import syncRoutes from '@/router/syncRoutes'
import router from '@/router/index'
// 递归过滤没有权限的路由
const filterRoute = (routes, pids, module) => {
  return routes.filter(route => {
    if (route.meta) {
      route.meta.module = module
    }
    if (route.children) {
      route.children = filterRoute(route.children, pids, module)
      if (route.children.length > 0) {
        return true
      } else {
        return false
      }
    } else {
      if (route.meta.pid) {
        return pids.findIndex(v => v === route.meta.pid) > -1
      }
      return true
    }
  })
}
const route = {
  state: {
    syncRoutes: syncRoutes,
    currentModule: ''
  },
  mutations: {
    UPDATE_MODULE (state, module) {
      state.currentModule = module
    },
    UPDATE_SYNC_ROUTES (state, routes) {
      state.syncRoutes = routes
    }
  },
  actions: {
    updateRoute ({ commit, state, rootState }) {
      const pids = rootState.user.pids
      let modules = state.syncRoutes
      for (const m in modules) {
        modules[m].routes = filterRoute(modules[m].routes, pids, modules[m].key)
      }
      modules = modules.filter(v => {
        return v.routes.length > 0
      })
      commit('UPDATE_SYNC_ROUTES', modules)
      for (const x of state.syncRoutes) {
        if (state.currentModule === '') {
          commit('UPDATE_MODULE', x.key)
        }
        router.addRoutes(x.routes)
      }
      router.addRoutes([
        {
          path: '*',
          redirect: { name: '404' }
        }
      ])
      return Promise.resolve()
    }
  },
  getters: {
    syncRoutes: state => state.syncRoutes,
    currentModule: state => state.currentModule,
    currentModuleTitle: state => {
      const index = state.syncRoutes.findIndex(v => v.key === state.currentModule)
      if (index > -1) {
        return state.syncRoutes[index].title
      }
      return ''
    },
    indexRoute: state => {
      const firstRoutes = state.syncRoutes[0].routes
      let url = ''
      if (firstRoutes[0]) {
        url += firstRoutes[0].path
      }
      if (firstRoutes[0].children) {
        url += '/' + firstRoutes[0].children[0].path
      }
      return url
    }
  }
}
export default route

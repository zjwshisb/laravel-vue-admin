import syncRoutes from '@/router/syncRoutes'
import router from '@/router/index'
// 递归过滤没有权限的侧边菜单
const filterRoute = (route, pids, module) => {
  if (route.meta) {
    route.meta.module = module
  }
  if (route.children) {
    route.children = route.children.filter(v => {
      return filterRoute(v, pids, module)
    })
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
      const modules = state.syncRoutes
      for (const module of modules) {
        for (const x in module.routes) {
          filterRoute(module.routes[x], pids, module.key)
          if (x.children <= 0) {
            module.routes.splice(x, 1)
          }
        }
      }
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
    indexRoute: state => state.syncRoutes[0].routes[0].children[0]
  }
}
export default route

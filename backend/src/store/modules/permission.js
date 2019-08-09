import { asyncRouterMap, constantRouterMap } from '@/router'

/**
 * 递归过滤异步路由表，返回符合用户权限的路由表
 * @param asyncRouterMap
 * @param permissions
 */
function filterAsyncRouter(asyncRouterMap, permissions) {
  const filter = v => {
    if (v.meta.permissions) {
      v.meta.permissions = v.meta.permissions.filter(pv => permissions.has(pv))
      return v.meta.permissions.length !== 0
    } else {
      v.children = v.children.filter(filter)
      return v.children.length !== 0
    }
  }
  permissions = new Set([...permissions])
  return asyncRouterMap.filter(value => {
    if (value.path === '*') return true
    value.children = value.children.filter(filter)
    return value.children.length !== 0
  })
}

const permission = {
  state: {
    routes: constantRouterMap,
    addRouters: []
  },
  mutations: {
    SET_ROUTERS: (state, routers) => {
      state.addRouters = routers
      state.routes = constantRouterMap.concat(routers)
    }
  },
  actions: {
    GenerateRoutes({ commit }, data) {
      return new Promise(resolve => {
        const { permissions } = data
        const accessedRouters = filterAsyncRouter(asyncRouterMap, permissions)
        commit('SET_ROUTERS', accessedRouters)
        resolve(accessedRouters)
      })
    }
  }
}

export default permission

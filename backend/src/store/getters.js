const getters = {
  sidebar: state => state.app.sidebar,
  device: state => state.app.device,
  token: state => state.user.token,
  name: state => state.user.name,
  permissions: state => state.user.permissions,
  routes: state => state.permission.routes,
  hasRouteName: state => name => {
    const func = v => {
      if (v.children && v.children.length > 0) {
        const index = v.children.findIndex(func)
        if (index > -1) {
          return true
        }
      } else {
        return v.name === name
      }
    }
    const index = state.permission.routes.findIndex(func)
    return index > -1
  }
}
export default getters

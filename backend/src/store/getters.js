const getters = {
  sidebar: state => state.app.sidebar,
  device: state => state.app.device,
  token: state => state.user.token,
  name: state => state.user.name,
  permissions: state => state.user.permissions,
  routes: state => state.permission.routes
}
export default getters

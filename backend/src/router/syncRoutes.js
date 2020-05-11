
const modulesFiles = require.context('./modules', true, /\.js$/)

const parseRoute = (module, route, root = true) => {
  if (root) {
    route.path = '/' + module + (route.path ? '/' + route.path : '')
  }
  if (route.name) {
    route.name = module.charAt(0).toUpperCase() + module.slice(1) + route.name
  }
  if (route.children) {
    parseRoute(module, route.children)
  }
}
const recursiveParse = (module, routes, root = true) => {
  for (const route of routes) {
    parseRoute(module, route, root)
    if (route.children) {
      recursiveParse(module, route.children, false)
    }
  }
}
const modules = modulesFiles.keys().reduce((modules, modulePath) => {
  // set './app.js' => 'app'
  const moduleName = modulePath.replace(/^\.\/(.*)\.\w+$/, '$1')
  const value = modulesFiles(modulePath)
  const routeModule = value.default
  recursiveParse(moduleName, routeModule.routes)
  modules[moduleName] = routeModule
  return modules
}, {})
export default modules

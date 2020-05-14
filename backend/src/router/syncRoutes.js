
const modulesFiles = require.context('./modules', true, /\.js$/)

const modules = modulesFiles.keys().reduce((modules, modulePath) => {
  const moduleName = modulePath.replace(/^\.\/(.*)\.\w+$/, '$1')
  const value = modulesFiles(modulePath)
  const routeModule = value.default
  modules.push(Object.assign(routeModule, { key: moduleName }))
  return modules
}, [])
modules.sort((v1, v2) => {
  return v1.sort - v2.sort
})
console.log(modules)
export default modules

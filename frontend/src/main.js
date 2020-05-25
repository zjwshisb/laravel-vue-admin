import './style/index.less'
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import antdv from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
import './routeGuard'
import './directives/permission'
import moment from 'moment'
import 'moment/locale/zh-cn'
import SearchForm from './components/search-form'
import SearchFormCol from './components/search-form/col'
import { errorReport } from './api/system'
moment.locale('zh-cn')
Vue.use(antdv)

Vue.component('search-form', SearchForm)
Vue.component('search-form-col', SearchFormCol)

Vue.config.productionTip = false
Vue.config.errorHandler = (error, vm, info) => {
  errorReport({
    message: error.message,
    name: error.name,
    stack: error.stack,
    info: info
  })
  throw error
}
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')

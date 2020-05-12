import './style/index.less'
import Vue from 'vue'
import App from './App.vue'
import router from './router'
import store from './store'
import antdv from 'ant-design-vue'
import 'ant-design-vue/dist/antd.css'
import './routeGuard'

import moment from 'moment'
import 'moment/locale/zh-cn'
moment.locale('zh-cn')
Vue.use(antdv)

Vue.config.productionTip = false

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')

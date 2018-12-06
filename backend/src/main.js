import Vue from 'vue'

import 'normalize.css/normalize.css'// A modern alternative to CSS resets

import ElementUI from 'element-ui'
import 'element-ui/lib/theme-chalk/index.css'
import locale from 'element-ui/lib/locale/lang/zh-CN' // lang i18n

import '@/styles/index.scss' // global css

import App from './App'
import router from './router'
import store from './store'
import '@/utils/extend'
import '@/icons' // icon
import '@/permission' // permission control
import elementUIVerify from 'element-ui-verify'
import { fetData } from '@/api/system'
Vue.prototype.$fetchData = fetData
Vue.use(ElementUI, { locale })
Vue.use(elementUIVerify)
Vue.config.productionTip = false

// 注册权限指令(v-permission="'users.update'"),根据权限控制页面元素显示与否
Vue.directive('permission', {
  inserted: function(el, binding, vnode) {
    const permission = new Set(vnode.context.$route.meta.permissions)
    if (!permission.has(binding.value)) {
      el.style.setProperty('display', 'none', 'important')
    }
  }
})

new Vue({
  el: '#app',
  router,
  store,
  template: '<App/>',
  components: { App }
})


import router from './router/index'
import store from './store/index'
import NProgress from 'nprogress'
import 'nprogress/nprogress.css'
import { getToken, setToken } from './util/token'
router.beforeEach((to, from, next) => {
  NProgress.start()
  if (getToken()) {
    if (to.name === 'Login') {
      if (store.getters.id) {
        next(store.getters.indexRoute)
      } else {
        store.dispatch('getUserInfo').then(() => {
          next(store.getters.indexRoute)
        }).catch(() => {
          setToken('')
          next()
        })
      }
    } else {
      if (!store.getters.id) {
        store.dispatch('getUserInfo').then(() => {
          // 重新跳转，确保异步路由加载成功
          next({ ...to, replace: true })
        }).catch(() => {
          next({ name: 'Login' })
        })
      } else {
        next()
      }
    }
  } else {
    if (to.name === 'Login') {
      next()
    } else {
      next({ name: 'Login' })
    }
  }
})
router.afterEach((to, from) => {
  const active = to.meta.activeUrl ? to.meta.activeUrl : to.path
  store.commit('UPDATE_MENU_ACTIVE_KEYS', active ? [active] : [])
  store.commit('UPDATE_MODULE', to.meta.module)
  NProgress.done()
})

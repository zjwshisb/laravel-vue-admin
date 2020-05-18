import router from './router/index'
import store from './store/index'
import NProgress from 'nprogress' // Progress 进度条
import 'nprogress/nprogress.css'// Progress 进度条样式
import { getToken, setToken } from './util/token'
router.beforeEach((to, from, next) => {
  NProgress.start()
  if (getToken()) {
    if (to.name === 'Login') {
      if (store.getters.id) {
        next('/')
      } else {
        store.dispatch('getUserInfo').then(() => {
          next({ name: 'SystemAccountList' })
        }).catch(() => {
          setToken('')
          next()
        })
      }
    } else {
      if (!store.getters.id) {
        store.dispatch('getUserInfo').then(() => {
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
router.afterEach(() => {
  NProgress.done()
})

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
        NProgress.done()
      } else {
        store.dispatch('getUserInfo').then(() => {
          next({ name: 'AdminAccountList' })
          NProgress.done()
        }).catch(() => {
          setToken('')
          next()
        })
      }
    } else {
      if (!store.getters.id) {
        store.dispatch('getUserInfo').then(() => {
          next({ ...to, replace: true })
          NProgress.done()
        }).catch(() => {
          next({ name: 'Login' })
          NProgress.done()
        })
      } else {
        next()
        NProgress.done()
      }
    }
  } else {
    if (to.name === 'Login') {
      next()
    } else {
      next({ name: 'Login' })
    }
    NProgress.done()
  }
})

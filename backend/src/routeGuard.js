import router from './router/index'
import store from './store/index'
import NProgress from 'nprogress' // Progress 进度条
import 'nprogress/nprogress.css'// Progress 进度条样式
router.beforeEach((to, from, next) => {
  NProgress.start()
  if (to.name === 'Login') {
    if (store.getters.id) {
      next('/')
      NProgress.done()
    } else {
      next()
      NProgress.done()
    }
  } else {
    if (!store.getters.id) {
      next({ name: 'Login' })
      NProgress.done()
    } else {
      next()
      NProgress.done()
    }
  }
})

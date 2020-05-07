import Vue from 'vue'
import VueRouter from 'vue-router'
import constantRoutes from './constRoutes'
Vue.use(VueRouter)

const router = new VueRouter({
  routes: constantRoutes
})

export default router

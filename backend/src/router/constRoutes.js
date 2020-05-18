const constantRoutes = [
  {
    path: '/',
    name: 'Login',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/login/index')
  },
  {
    path: '/',
    component: () => import('../layout/index'),
    children: [
      {
        path: '404',
        name: '404',
        component: () => import(/* webpackChunkName: "about" */ '../views/404/index')
      }
    ]
  }
]
export default constantRoutes

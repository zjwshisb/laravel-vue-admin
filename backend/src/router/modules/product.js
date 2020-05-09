import Layout from '@/layout/Index'

const module = {
  title: '模块2',
  routes: [
    {
      path: '/system',
      component: Layout,
      meta: {
        title: '商品管理'
      },
      children: [
        {
          path: 'admin',
          name: 'SystemAdmin',
          meta: {
            permission: [],
            title: '商品'
          },
          component: () => import(/* webpackChunkName: "about" */ '@/views/system/Admin'),
        },
        {
          path: 'cache',
          name: 'SystemCache',
          meta: {
            permission: [],
            title: '分裂'
          },
          component: () => import(/* webpackChunkName: "about" */ '@/views/system/Cache')
        }
      ]
    }
  ]
}
export default module

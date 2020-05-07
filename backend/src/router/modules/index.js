import Layout from '@/layout/Index'

const module = {
  title: '基本信息',
  routes: [
    {
      path: '/system',
      component: Layout,
      meta: {
        title: '系统管理'
      },
      children: [
        {
          path: 'admin',
          name: 'SystemAdmin',
          meta: {
            permission: [],
            title: '管理员',
            auth: false
          },
          component: () => import(/* webpackChunkName: "about" */ '@/views/system/Admin')
        },
        {
          path: 'cache',
          name: 'SystemCache',
          meta: {
            permission: [],
            title: '缓存管理'
          },
          component: () => import(/* webpackChunkName: "about" */ '@/views/system/Cache')
        }
      ]
    }
  ]
}
export default module

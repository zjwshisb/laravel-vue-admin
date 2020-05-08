import Layout from '@/layout/Index'
const module = {
  title: '基本信息',
  routes: [
    {
      path: '',
      component: Layout,
      meta: {
        title: 'dashboard'
      },
      children: [
        {
          path: 'dashboard',
          name: 'SystemDashboard',
          meta: {
            title: 'dashboard',
            icon: 'dashboard',
            hiddenBreadcrumb: true
          }
        }
      ]
    },
    {
      path: 'system',
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
            auth: false,
            icon: 'dashboard'
          },
          component: () => import(/* webpackChunkName: "about" */ '@/views/system/Admin'),
          redirect: { name: 'IndexSystemAdminList' },
          children: [
            {
              path: 'add',
              name: 'SystemAdminAdd',
              component: () => import(/* webpackChunkName: "about" */ '@/views/system/add'),
              meta: {
                title: '新增管理员'
              }
            },
            {
              path: 'list',
              name: 'SystemAdminList',
              component: () => import(/* webpackChunkName: "about" */ '@/views/system/list'),
              meta: {
                title: '管理员列表',
                hiddenBreadcrumb: true
              }
            }
          ]
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

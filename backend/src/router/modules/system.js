import Layout from '@/layout/index'
const module = {
  title: '系统设置',
  sort: 2,
  routes: [
    {
      path: '/system',
      component: Layout,
      meta: {
        title: '登录账号',
        icon: 'user'
      },
      children: [
        {
          path: 'account',
          name: 'SystemAccountLayout',
          component: () => import('@/views/system/admin/index'),
          meta: {
            title: '登录账号',
            hiddenBreadcrumb: true
          },
          redirect: { name: 'SystemAccountList' },
          children: [
            {
              path: 'list',
              name: 'SystemAccountList',
              meta: {
                title: '列表',
                hiddenBreadcrumb: true,
                pid: 11000
              },
              component: () => import('@/views/system/admin/list')
            },
            {
              path: 'add',
              name: 'SystemAccountAdd',
              meta: {
                title: '新增',
                pid: 11100
              },
              component: () => import('@/views/system/admin/form')
            },
            {
              path: ':id/edit',
              name: 'SystemAccountEdit',
              meta: {
                title: '编辑',
                pid: 11200
              },
              component: () => import('@/views/system/admin/form')
            }
          ]
        }
      ]
    },
    {
      path: '/system',
      component: Layout,
      meta: {
        title: '权限组',
        icon: 'eye'
      },
      children: [
        {
          path: 'role',
          name: 'SystemRoleLayout',
          meta: {
            title: '权限组',
            hiddenBreadcrumb: true
          },
          redirect: {
            name: 'SystemRoleList'
          },
          component: () => import('@/views/system/role/index'),
          children: [
            {
              path: 'list',
              name: 'SystemRoleList',
              meta: {
                title: '列表',
                hiddenBreadcrumb: true,
                pid: 12000
              },
              component: () => import('@/views/system/role/list')
            },
            {
              path: 'add',
              name: 'SystemRoleAdd',
              meta: {
                title: '新增',
                pid: 12100
              },
              component: () => import('@/views/system/role/form')
            },
            {
              path: ':id/edit',
              name: 'SystemRoleEdit',
              meta: {
                title: '编辑',
                pid: 12200
              },
              component: () => import('@/views/system/role/form')
            }
          ]
        }
      ]
    }
  ]
}
export default module

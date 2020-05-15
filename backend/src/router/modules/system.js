import Layout from '@/layout/index'
const module = {
  title: '系统设置',
  sort: 2,
  routes: [
    {
      path: '/admin',
      component: Layout,
      meta: {
        title: '登录账号',
        icon: 'user'
      },
      children: [
        {
          path: 'account',
          name: 'AdminAccountLayout',
          component: () => import('@/views/system/admin/index'),
          meta: {
            title: '登录账号',
            hiddenBreadcrumb: true
          },
          redirect: { name: 'AdminAccountList' },
          children: [
            {
              path: 'list',
              name: 'AdminAccountList',
              meta: {
                permission: [],
                title: '列表',
                hiddenBreadcrumb: true
              },
              component: () => import('@/views/system/admin/list')
            },
            {
              path: 'add',
              name: 'AdminAccountAdd',
              meta: {
                permission: [],
                title: '新增'
              },
              component: () => import('@/views/system/admin/form')
            },
            {
              path: ':id/edit',
              name: 'AdminAccountEdit',
              meta: {
                permission: [],
                title: '编辑'
              },
              component: () => import('@/views/system/admin/form')
            }
          ]
        }
      ]
    },
    {
      path: '/admin',
      component: Layout,
      meta: {
        title: '权限组',
        icon: 'eye'
      },
      children: [
        {
          path: 'role',
          name: 'AdminRoleLayout',
          meta: {
            title: '权限组',
            hiddenBreadcrumb: true
          },
          redirect: {
            name: 'AdminRoleList'
          },
          component: () => import('@/views/system/role/index'),
          children: [
            {
              path: 'list',
              name: 'AdminRoleList',
              meta: {
                permission: [],
                title: '列表',
                hiddenBreadcrumb: true
              },
              component: () => import('@/views/system/role/list')
            },
            {
              path: 'add',
              name: 'AdminRoleAdd',
              meta: {
                permission: [],
                title: '新增'
              },
              component: () => import('@/views/system/role/form')
            },
            {
              path: ':id/edit',
              name: 'AdminRoleEdit',
              meta: {
                permission: [],
                title: '编辑'
              },
              component: () => import('@/views/system/admin/form')
            }
          ]
        }
      ]
    }
  ]
}
export default module

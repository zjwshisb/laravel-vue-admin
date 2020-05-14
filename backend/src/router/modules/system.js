import Layout from '@/layout/index'
const module = {
  title: '系统设置',
  sort: 2,
  routes: [
    {
      path: '/admin',
      component: Layout,
      meta: {
        title: '权限管理',
        icon: 'user'
      },
      children: [
        {
          path: 'account',
          name: 'AdminAccountLayout',
          component: () => import('@/views/system/admin/index'),
          meta: {
            title: '登录账号'
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
      path: '/role',
      component: Layout,
      meta: {
        title: '权限组'
      },
      children: [
      ]
    }
  ]
}
export default module

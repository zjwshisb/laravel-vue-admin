import Layout from '@/layout/index'

const module = {
  title: '系统设置',
  sort: 2,
  routes: [
    {
      path: 'admin',
      component: Layout,
      meta: {
        title: '管理员'
      },
      children: [
        {
          path: 'list',
          name: 'AdminList',
          meta: {
            permission: [],
            title: '管理员',
            hiddenBreadcrumb: true,
            icon: 'user'
          },
          component: () => import('@/views/system/admin/index')
        },
        {
          path: 'add',
          name: 'AdminAdd',
          meta: {
            permission: [],
            title: '新增管理员'
          },
          hidden: true,
          component: () => import('@/views/system/admin/add')
        }
      ]
    }
  ]
}
export default module

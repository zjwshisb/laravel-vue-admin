import Layout from '@/layout/Index'

const module = {
  title: '系统设置',
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
          name: 'SystemAdmin',
          meta: {
            permission: [],
            title: '管理员',
            hiddenBreadcrumb: true
          },
          component: () => import('@/views/system/admin/index')
        },
        {
          path: 'add',
          name: 'SystemAdminAdd',
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

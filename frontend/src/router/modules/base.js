import Layout from '@/layout/index'
const module = {
  title: '基本设置',
  sort: 2,
  routes: [
    {
      path: '/base',
      component: Layout,
      meta: {
        title: 'dashboard',
        icon: 'dashboard'
      },
      children: [
        {
          path: 'dashboard',
          component: () => import('@/views/base/dashboard/index'),
          name: 'BaseDashboard',
          meta: {
            title: 'dashboard',
            hiddenBreadcrumb: true
          }
        }
      ]
    }
  ]
}
export default module

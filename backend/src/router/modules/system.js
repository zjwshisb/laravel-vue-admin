import Layout from '@/layout/index'
const module = {
  title: '系统设置',
  sort: 2,
  routes: [
    {
      path: '/system',
      component: Layout,
      meta: {
        title: 'dashboard',
        icon: 'dashboard'
      },
      children: [
        {
          path: 'dashboard',
          component: () => import('@/views/system/dashboard/index'),
          name: 'SystemDashboard',
          meta: {
            title: 'dashboard',
            hiddenBreadcrumb: true
          }
        }
      ]
    },
    {
      path: '/system',
      component: Layout,
      meta: {
        title: '系统账号',
        icon: 'user'
      },
      children: [
        {
          path: 'account',
          name: 'SystemAccountLayout',
          component: () => import('@/views/system/admin/index'),
          meta: {
            title: '账号列表'
          },
          redirect: { name: 'SystemAccountList' },
          children: [
            {
              path: 'list',
              name: 'SystemAccountList',
              meta: {
                title: '列表',
                hiddenBreadcrumb: true,
                pid: 11100,
                activeMenuName: 'SystemAccountLayout'
              },
              component: () => import('@/views/system/admin/list')
            },
            {
              path: 'add',
              name: 'SystemAccountAdd',
              meta: {
                title: '新增',
                pid: 11110,
                activeMenuName: 'SystemAccountLayout'
              },
              component: () => import('@/views/system/admin/form')
            },
            {
              path: ':id/edit',
              name: 'SystemAccountEdit',
              meta: {
                title: '编辑',
                pid: 11120,
                activeMenuName: 'SystemAccountLayout'
              },
              component: () => import('@/views/system/admin/form')
            }
          ]
        },
        {
          path: 'account/action-logs',
          name: 'SystemAccountActionLog',
          component: () => import('@/views/system/admin/action-log'),
          meta: {
            title: '操作记录',
            pid: 11200
          }
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
                pid: 12000,
                activeMenuName: 'SystemRoleLayout'
              },
              component: () => import('@/views/system/role/list')
            },
            {
              path: 'add',
              name: 'SystemRoleAdd',
              meta: {
                title: '新增',
                pid: 12100,
                activeMenuName: 'SystemRoleLayout'
              },
              component: () => import('@/views/system/role/form')
            },
            {
              path: ':id/edit',
              name: 'SystemRoleEdit',
              meta: {
                title: '编辑',
                pid: 12200,
                activeMenuName: 'SystemRoleLayout'
              },
              component: () => import('@/views/system/role/form')
            }
          ]
        }
      ]
    },
    {
      path: '/system',
      component: Layout,
      meta: {
        title: '运维',
        icon: 'sliders'
      },
      children: [
        {
          path: 'frontend-error',
          name: 'SystemFrontendError',
          meta: {
            title: '前端异常',
            pid: 13100
          },
          component: () => import('@/views/system/devops/frontend-error')
        },
        {
          path: 'queue',
          name: 'SystemQueue',
          meta: {
            title: '队列面板',
            pid: 13200
          },
          component: () => import('@/views/system/devops/queue')
        }
      ]
    }
  ]
}
export default module

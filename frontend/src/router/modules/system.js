import Layout from '@/layout/index'
// 侧边菜单最多显示2级，当超过2级时，可通过页面路由进行导航（通过v-pid="111000"控制显示与否）
// 当二级菜单只有一个需要显示的时候会提升到一级菜单显示

const module = {
  title: '系统设置', // 顶部菜单显示名称，只有一个顶部菜单时不会显示
  sort: 100, // 顶部菜单排序
  routes: [
    {
      path: '/system',
      component: Layout,
      meta: {
        title: 'dashboard',
        icon: 'dashboard' // and-design-vue icon组件名称
      },
      children: [
        {
          path: 'dashboard',
          component: () => import('@/views/system/dashboard/index'),
          name: 'SystemDashboard',
          meta: {
            title: 'dashboard',
            hiddenBreadcrumb: true // 在面包屑隐藏
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
          component: () => import('@/views/system/admin/index'), // 此组件只有一个 router-view
          meta: {
            title: '账号列表',
            activeMenuName: 'SystemAccountLayout'
          },
          children: [ // 三级子菜单，通过页面导航跳转
            {
              path: '',
              name: 'SystemAccountList',
              meta: {
                title: '列表',
                hiddenBreadcrumb: true,
                pid: 11100 // 权限id 与 v-pid='11100' 一样, 不存在时则不进行权限判断
              },
              component: () => import('@/views/system/admin/list')
            },
            {
              path: 'add',
              name: 'SystemAccountAdd',
              meta: {
                title: '新增',
                pid: 11110,
                activeUrl: '/system/account'
              },
              component: () => import('@/views/system/admin/form')
            },
            {
              path: ':id/edit',
              name: 'SystemAccountEdit',
              meta: {
                title: '编辑',
                pid: 11120,
                activeUrl: '/system/account'
              },
              component: () => import('@/views/system/admin/form')
            }
          ]
        },
        {
          path: 'account/action-logs',
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
        icon: 'eye',
        hiddenBreadcrumb: true // 当菜单下只有一个显示的子菜单时需要隐藏
      },
      children: [
        {
          path: 'role',
          meta: {
            title: '权限组'
          },
          component: () => import('@/views/system/role/index'),
          children: [
            {
              path: '',
              name: 'SystemRoleList',
              meta: {
                title: '列表',
                hiddenBreadcrumb: true,
                pid: 12000,
                activeUrl: '/system/role'
              },
              component: () => import('@/views/system/role/list')
            },
            {
              path: 'add',
              name: 'SystemRoleAdd',
              meta: {
                title: '新增',
                pid: 12100,
                activeUrl: '/system/role'
              },
              component: () => import('@/views/system/role/form')
            },
            {
              path: ':id/edit',
              name: 'SystemRoleEdit',
              meta: {
                title: '编辑',
                pid: 12200,
                activeUrl: '/system/role'
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
        },
        {
          path: 'route',
          name: 'SystemRoute',
          meta: {
            title: '后端路由',
            pid: 13300
          },
          component: () => import('@/views/system/devops/route')
        },
        {
          path: 'redis',
          name: 'SystemRedis',
          meta: {
            title: 'redis',
            pid: 13400
          },
          component: () => import('@/views/system/devops/redis')
        }
      ]
    },
    {
      path: '/system',
      component: Layout,
      meta: {
        title: '运维',
        icon: 'file-text'
      },
      children: [
        {
          path: 'log',
          name: 'SystemLog',
          meta: {
            title: '系统日志',
            pid: 14000
          },
          component: () => import('@/views/system/log/index')
        }
      ]
    }

  ]
}
export default module

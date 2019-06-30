# laravel，vue.js，element-ui 前后端分离的后台快速开发整合包
## Description
本项目由[laravel](https://github.com/laravel/laravel),[PanJiaChen/vue-element-admin](https://github.com/PanJiaChen/vue-element-admin)
[element-ui](https://github.com/ElemeFE/element)整合修改而成，权限控制精确到按钮，开箱即用，
## Start
```shell
# 安装php依赖，配置.env
$ composer install 
$ php artisan migrate  
$ php artisan db:seed
# 前端依赖
$ cd backend    
$ npm install 
# 修改frontend/config/dev.env.js BASE_API 
$ npm run dev  // 运行
```
## Permission
1.权限方面整合 [spatie/laravel-permission](https://github.com/spatie/laravel-permission),在此基础上修改了表结构，增加了
若干说明字段，根据路由判断权限  
2.在登录的时候返回用户的所有权限放在store中，通过与下面的asyncRouterMap取交集过滤无权限菜单  
3.在frontend/src/router/index.js中 meta.permissions包含这个页面所用到的权限(即后端路由)
```javascript
export const asyncRouterMap = [
  {
    path: '/system',
    component: Layout,
    meta: { title: '系统管理', icon: 'system' },
    children: [
      {
        path: 'role',
        name: 'system-role',
        component: () => import('@/views/system/role'),
        meta: { title: '权限', icon: 'role',
          permissions: ['roles.index', 'roles.update', 'roles.destroy', 'roles.store'] }
      }
    ]
  },
  { path: '*', redirect: '/404', hidden: true }
]
```
4.在页面中,通过v-permission="roles.store" 判断按钮是否显示(如下)  
```html
<el-button v-permission="'roles.store'" @click="handleAddRole">新增角色</el-button>
```
5.整合一些常用的包  
* [barryvdh/laravel-cors](https://github.com/barryvdh/laravel-cors)
* [spatie/laravel-permission](https://github.com/spatie/laravel-permission)
* [overtrue/laravel-lang](https://github.com/overtrue/laravel-lang)
* [barryvdh/laravel-ide-helper](https://github.com/barryvdh/laravel-ide-helper)
* [mnabialek/laravel-sql-logger](https://github.com/mnabialek/laravel-sql-logger)




  

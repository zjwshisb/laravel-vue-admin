# laravel，vue.js，Ant Design of Vue 前后端分离的后台快速开发整合包
## Description
整合andv和laravel的前后端分离开发整合包，开箱即用，方便快速开发，页面权限精确到按钮
## Start
```shell
# 安装php依赖，配置.env
$ composer install 
$ php artisan migrate  
$ php artisan db:seed
# 前端依赖
$ cd backend    
$ npm install 
# 修改frontend/.env.* 文件相关配置
$ npm run dev  // 运行
```
## other
1.权限方面整合 [spatie/laravel-permission](https://github.com/spatie/laravel-permission)  
2.权限菜单在config/adminmenus.php配置，修改之后通过 php artisan db:seed 进行更新  
2.在登录的时候返回用户的所有权限pid放在store中，通过与路由pid比较滤无权限菜单，详情见 fronted/src/router相关文件  
4.在页面中，通过自定义指令v-pid="11000"判断元素（按钮，跳转链接etc）是否显示  
5.前端增加调试bar，可查看请求的相关信息  
6.前端请求已根据laravel的相关响应对状态码做好了适配(表单验证失败等等)
7.前端页面通过iframe内嵌了horizon面板





  

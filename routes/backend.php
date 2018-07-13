<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register backend routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "backend" middleware group. Enjoy building your backend!
|
*/
Route::apiResource('tokens','TokenController');

Route::group(['middleware' => ['auth:backend']],function () {
    Route::apiResources([
        'users'=> 'UserController',
        'roles'=> 'RoleController',
        'admins'=> 'AdminController'
    ]);
});

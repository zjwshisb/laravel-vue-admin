<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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
Route::post('tokens','TokenController@store');
Route::group(['middleware' => ['auth:backend','permission']],function () {
    Route::apiResources([
        'roles'=> 'RoleController',
        'admins'=> 'AdminController'
    ]);
    Route::get('data',"DataController@index");
    Route::get('me', 'MeController@index');
});

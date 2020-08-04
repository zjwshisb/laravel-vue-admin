<?php
Route::post('/tokens', 'TokenController@store');
Route::get('/tokens', 'TokenController@index');
Route::post('/frontend-error','FrontendErrorController@store');


Route::middleware(['auth:admin'])->group(function () {
    Route::get('me', 'MeController@index');
    Route::post('me/password', 'MeController@password');
    Route::get('system/dashboard','SystemDashboardController@index');

});
Route::middleware(['auth:admin','permission', 'admin-action-record'])->group(function (){
    Route::get('admins','AdminController@index');
    Route::get('admin/{id}', 'AdminController@show')->where('id', '[0-9]+');
    Route::get('admin/options', 'AdminController@options');
    Route::post('admins','AdminController@store');
    Route::put('admins/{id}','AdminController@update');
    Route::delete('admins/{id}','AdminController@destroy');
    Route::put('admin/{id}/password','AdminController@password');

    Route::post('roles','RoleController@store');
    Route::put('roles/{id}','RoleController@update');
    Route::delete('roles/{id}','RoleController@destroy');
    Route::get('roles','RoleController@index');
    Route::get('roles/{id}','RoleController@show')
        ->where('id','[0-9]+');
    Route::get('roles/options','RoleController@options');

    Route::get('admin-action-logs','AdminActionLogController@index');

    Route::get('frontend-errors','FrontendErrorController@index');
    Route::post('frontend-errors/flush','FrontendErrorController@flush');

    Route::get('system-logs','SystemLogController@index');
    Route::get('system-logs/content','SystemLogController@content');
    Route::delete('system-logs', 'SystemLogController@destroy');
    Route::get('system/redis','SystemController@redis');
    Route::get('routes','RouteController@index');

});

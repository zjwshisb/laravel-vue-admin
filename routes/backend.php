<?php
Route::post('/tokens', 'TokenController@store');
Route::get('/tokens', 'TokenController@index');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('options', 'OptionController@index');
    Route::get('me', 'MeController@index');
    Route::post('me/password', 'MeController@password');
    Route::get('admins','AdminController@index')->name('backend.admins.index');
    Route::post('admins','AdminController@store')->name('backend.admins.store');
    Route::put('admins/{id}','AdminController@update')->name('backend.admins.update');
    Route::delete('admins/{id}','AdminController@destroy')->name('backend.admins.destroy');

    Route::post('roles','RoleController@store')->name('backend.roles.store');
    Route::put('roles/{id}','RoleController@update')->name('backend.roles.update');
    Route::delete('roles/{id}','RoleController@destroy')->name('backend.roles.destroy');
    Route::get('roles','RoleController@index')->name('backend.roles.index');
    Route::get('roles/{id}','RoleController@show')->name('backend.roles.show');
});

<?php
Route::post('/tokens', 'TokenController@store');
Route::get('/tokens', 'TokenController@index');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('me', 'MeController@index');
    Route::post('me/password', 'MeController@password');
    Route::get('admins','AdminController@index')->name('backend.admins.index');
    Route::post('admins','AdminController@store')->name('backend.admins.store');
    Route::put('admins/{id}','AdminController@update')->name('backend.admins.update');
    Route::delete('admins/{id}','AdminController@destroy')->name('backend.admins.destroy');
});

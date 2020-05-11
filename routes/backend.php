<?php
Route::post('/tokens', 'TokenController@store');
Route::get('/tokens', 'TokenController@index');

Route::middleware(['auth:admin'])->group(function () {
    Route::get('me', 'MeController@index');
});

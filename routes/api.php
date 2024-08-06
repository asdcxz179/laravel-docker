<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['admin'])->namespace('App\Http\Controllers')->group(function(){
    $middleware = [
        'auth:sanctum',
    ];

    Route::middleware($middleware)->prefix('system')->name('system.')->namespace('System')->group(function() {
        /* 網站列表*/
        Route::resource('website', 'WebsiteController');
    });

});
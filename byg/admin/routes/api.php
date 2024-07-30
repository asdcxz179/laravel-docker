<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['admin'])->prefix('api')->name('api.')->namespace('Byg\Admin\Http\Controllers')->group(function(){
    // /* 初始化設定 */
    // Route::resource('Init', 'System\InitController');
    $middleware = [
        'auth:sanctum',
        // 'admin.auth',
        // 'admin.admin',
    ];

    Route::prefix('admin')->name('admin.')->namespace('Admin')->group(function() use ($middleware){
        /*管理員登入*/
        Route::resource('login', 'Auth\LoginController')->only(['store']);

        Route::middleware($middleware)->group(function () {
            /* 管理員列表 */
            Route::resource('users', 'UserController');
        });
    });

    Route::middleware($middleware)->group(function () {
        // Route::prefix('media')->name('media.')->group(function(){
        //     /* 圖片庫 */
        //     Route::resource('image', 'Media\ImagesController');
        //     /* 圖片庫 */
        //     Route::resource('ckeditor', 'Media\CkeditorUploadController');
        //     /* 上傳圖片 */
        //     // Route::post('media/upload', 'Media\UploadController@store')->name('media.upload');
        // });

        // /* 儀錶板 */
        // Route::resource('dashboard', 'System\DashboardController');
        // /* 變更密碼 */
        // Route::resource('password', 'Auth\PasswordController');
        // /* 變更密碼 */
        // Route::resource('logout', 'Auth\LogoutController');
        // /* 管理員管理 */
        // Route::resource('admin', 'Admin\UsersController');
        // /* 網站設定 */
        // Route::resource('SystemSettings', 'System\SettingsController', ['only' => ['index','store']]);

        
    //     // /* 管理人員登入紀錄 */
    //     // Route::resource('LoginRecord', 'Admin\LoginRecordController', ['only' => ['show', 'index']]);
    //     // /* 管理人員操作紀錄 */
    //     // Route::resource('OperateRecord', 'Admin\OperateRecordController', ['only' => ['show', 'index']]);
    //     // /* 管理人員螢幕鎖定 */
    //     // Route::resource('LockScreen', 'System\LockScreenController', ['only' => ['index']]);
        
    });
});

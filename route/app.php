<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use app\middleware\Admin;
use app\middleware\Auth;
use app\middleware\Task;
use app\middleware\UserIndex;
use think\facade\Route;


// 注册index
Route::rule('/', 'index/index');
Route::get('index', 'index/index');

// 注册userindex
Route::rule('user/', 'user/index')->middleware(UserIndex::class);
Route::group('user', function () {
    Route::get('/', 'user/index');
    Route::get('index', 'user/index');
    Route::get('update', 'user/update');
    Route::get('logout', 'user/logout');
})->middleware(UserIndex::class);

Route::post('/user/login', 'user/login')->middleware(Auth::class);
Route::post('/user/task', 'task/index')->middleware(Task::class);

// 注册admin
Route::rule('admin/', 'admin/index')->middleware(UserIndex::class);
Route::group('admin', function () {
    Route::rule('/', 'admin/index');
    Route::get('index', 'admin/index');
    Route::get('user', 'admin/user');
})->middleware(Admin::class);

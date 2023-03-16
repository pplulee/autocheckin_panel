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
    Route::delete('user/:id', 'admin/userDelete');
    Route::get('user/:id', 'admin/userDetail');
    Route::post('user/:id', 'admin/userUpdate');
    Route::get('user', 'admin/user');
    Route::delete('task/:id', 'admin/taskDelete');
    Route::get('task/:id', 'admin/taskDetail');
    Route::post('task/:id', 'admin/taskUpdate');
    Route::get('task', 'admin/task');
    Route::get('setting', 'admin/settingDetail');
    Route::post('setting', 'admin/settingUpdate');
})->middleware(Admin::class);

<?php

namespace app\controller;

use app\BaseController;
use think\facade\Session;

class IndexController extends BaseController
{
    public function index()
    {
        // 登录判断
        if (Session::get('user_id')) {
            return redirect('/user/index');
        }
        return view('index', [
            'enable_register' => env('enable_register')]);
    }
}

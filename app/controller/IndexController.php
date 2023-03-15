<?php

namespace app\controller;

use app\BaseController;
use think\facade\Session;
use think\response\View;

class IndexController extends BaseController
{
    public function index()
    {
        if (Session::get('user_id')) {
            return alert("error", "您已登录", "2000", "/user/index");
        }
        return view('index', [
            'enable_register' => env('enable_register')]);
    }
}

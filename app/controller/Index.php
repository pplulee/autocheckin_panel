<?php
namespace app\controller;

use app\BaseController;

class Index extends BaseController
{
    public function index()
    {
        // 需要增加登录判断
        return view('index',[
            'enable_register' => env('enable_register'),
            ]);
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
}

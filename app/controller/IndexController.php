<?php

namespace app\controller;

use app\BaseController;

class IndexController extends BaseController
{
    public function index()
    {
        return view('index', [
            'enable_register' => env('enable_register')]);
    }
}

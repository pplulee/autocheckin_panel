<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Setting;
use app\model\User;

class AdminController extends BaseController
{
    public function index(): \think\response\View
    {
        $setting = new Setting();
        $last_api_time = $setting->getLastUpdate();
        $user = new User();
        $version = $user->MySQLVersion();
        $userCount = $user->numOfUsers();
        return view('/admin/index', ['last_api_time' => $last_api_time,
            'userCount' => $userCount, 'version' => $version]);
    }
}
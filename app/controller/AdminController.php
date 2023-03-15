<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Setting;
use app\model\User;
use think\facade\Session;

class AdminController extends BaseController
{
    public function index()
    {
        if (!Session::get('user_id')) {
            return redirect('/index');
        }
        $setting = new Setting();
        $last_api_time = $setting->getLastUpdate();
        $user = new User();
        $version = $user->MySQLVersion();
        $userCount = $user->numOfUsers();
        if ($user->isAdmin(Session::get('user_id'))){
            return view('/admin/index', ['last_api_time' => $last_api_time,
                'userCount' => $userCount, 'version' => $version]);
        }else{
            return alert("error", "你不是管理员", "2000", "/user/index");
        }
    }

}
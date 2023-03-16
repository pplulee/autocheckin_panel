<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Setting;
use app\model\User;
use app\model\Task;
use think\response\View;

class AdminController extends BaseController
{
    public function index(): View
    {
        $setting = new Setting();
        $last_api_time = $setting->getLastUpdate();
        $user = new User();
        $version = $user->MySQLVersion();
        $userCount = $user->numOfUsers();
        return view('/admin/index', ['last_api_time' => $last_api_time,
            'userCount' => $userCount, 'version' => $version]);
    }

    public function user(): View
    {
        $user = new User();
        // 每页25条数据
        $userList = $user->paginate(25);
        $page = $userList->render();
        return view('/admin/user', ['users' => $userList, 'page' => $page]);
    }

    public function task(): View
    {
        $task = new Task();
        // 每页25条数据
        $taskList = $task->paginate(25);
        $page = $taskList->render();
        return view('/admin/task', ['tasks' => $taskList, 'page' => $page]);
    }
}
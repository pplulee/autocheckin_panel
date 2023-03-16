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

    public function userDetail($id)
    {
        $user = new User();
        $user = $user->fetch($id);
        if (!$user){
            return alert("error", "用户不存在", "2000", "/admin/user");
        }
        return view('/admin/userDetail', ['user' => $user]);
    }

    public function userUpdate($id)
    {
        $data = $this->request->post();
        $data['admin'] = $this->request->post('admin')=="on";
        $user = new User();
        if (!$user->updateUser($data)){
            return alert("error", "用户不存在", "2000", "/admin/user");
        }
        return alert("success", "修改成功", "2000", "/admin/user");
    }

    public function userDelete($id)
    {
        // Method: DELETE
        $user = new User();
        if (!$user->deleteUser($id)){
            return json(['status' => 'error', 'msg' => '用户不存在']);
        }
        return json(['status' => 'success', 'msg' => '删除成功']);
    }
}
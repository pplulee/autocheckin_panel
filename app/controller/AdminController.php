<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Setting;
use app\model\Task;
use app\model\User;
use think\response\Json;
use think\response\View;

class AdminController extends BaseController
{
    public function index(): View
    {
        $setting = new Setting();
        $user = new User();
        $task = new Task();
        $taskCount = $task->numOfTasks();
        $last_api_time = $setting->getSetting('last_update');
        $version = $user->MySQLVersion();
        $userCount = $user->numOfUsers();
        return view('/admin/index', ['last_api_time' => $last_api_time,
            'userCount' => $userCount, 'version' => $version, 'taskCount' => $taskCount]);
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
        if (!$user) {
            return alert("error", "用户不存在", "2000", "/admin/user");
        }
        return view('/admin/userDetail', ['user' => $user]);
    }

    public function userUpdate($id): string
    {
        $data = $this->request->post();
        $data['admin'] = $this->request->post('admin') == "on";
        $user = new User();
        if (!$user->updateUser($data)) {
            return alert("error", "用户不存在", "2000", "/admin/user");
        }
        return alert("success", "修改成功", "2000", "/admin/user");
    }

    public function userDelete($id): Json
    {
        // Method: DELETE
        $user = new User();
        if (!$user->deleteUser($id)) {
            return json(['status' => 'error', 'msg' => '用户不存在']);
        }
        return json(['status' => 'success', 'msg' => '删除成功']);
    }

    public function taskDetail($id)
    {
        $task = new Task();
        $task = $task->fetch($id);
        if (!$task) {
            return alert("error", "任务不存在", "2000", "/admin/task");
        }
        return view('/admin/taskDetail', ['task' => $task]);
    }

    public function taskUpdate($id): string
    {
        $data = $this->request->post();
        $task = new Task();
        if (!$task->updateTask($id, $data)) {
            return alert("error", "任务不存在", "2000", "/admin/task");
        }
        return alert("success", "修改成功", "2000", "/admin/task");
    }

    public function taskDelete($id)
    {
        // Method: DELETE
        $task = new Task();
        if (!$task->deleteTask($id)) {
            return json(['status' => 'error', 'msg' => '任务不存在']);
        }
        return json(['status' => 'success', 'msg' => '删除成功']);
    }

    public function settingDetail()
    {
        $setting = new Setting();
        $setting = $setting->getAllSetting();
        return view('/admin/setting', ['setting' => $setting]);
    }

    public function settingUpdate()
    {
        $data = $this->request->post();
        $setting = new Setting();
        $setting->updateSetting($data['setting']);
        return alert("success", "修改成功", "2000", "/admin/setting");
    }
}
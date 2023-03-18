<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Task;
use think\facade\Session;

class TaskController extends BaseController
{
    public function index(): string
    {
        if ($this->request->post('update')) {
            return $this->update();
        } else if ($this->request->post('delete')) {
            return $this->delete();
        }
        return alert("error", "未知操作", "2000", "/user/index#checkin");
    }

    public function update(): string
    {
        $task = new Task();
        $task = $task->fetchByUser(Session::get('user_id'));
        $id = $task->updateTask($task ? $task->id : -1, ['username' => $this->request->post('username'),
            'password' => $this->request->post('password'),
            'tgbot_chat_id' => $this->request->post('tgbot_chat_id'),
            'tgbot_token' => $this->request->post('tgbot_token'),
            'wxpusher_uid' => $this->request->post('wxpusher_uid'),
            'userid' => Session::get('user_id')]);
        app()->taskService->backendSetTask($id);
        return alert("success", "修改成功", "2000", "/user/index");
    }

    public function delete(): string
    {
        $task = new Task();
        $task = $task->fetchByUser(Session::get('user_id'));
        if ($task->id == -1) {
            return alert("error", "任务不存在", "2000", "/user/index");
        } else {
            $task->delete();
            return alert("success", "删除成功", "2000", "/user/index");
        }
    }

    public function add(): string
    {
        $task = new Task();
        $id = $task->addTask(Session::get('id'), ['username' => $this->request->post('username'),
            'password' => $this->request->post('password'),
            'tgbot_chat_id' => $this->request->post('tgbot_chat_id'),
            'tgbot_token' => $this->request->post('tgbot_token'),
            'wxpusher_uid' => $this->request->post('wxpusher_uid'),
            'userid' => Session::get('user_id')]);
        return alert("success", "添加成功", "2000", "/user/index");
    }
}

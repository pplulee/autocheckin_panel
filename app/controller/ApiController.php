<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Setting;
use app\model\Task;
use think\response\Json;

class ApiController extends BaseController
{
    public function get_list(): Json
    {
        $task = new Task();
        $taskList = $task->fetchAllId();
        return json(["code" => 200, "msg" => "ok", "data" => $taskList]);
    }

    public function get_param(): Json
    {
        if ($this->request->post("task_id")) {
            $task = new Task();
            if ($task->checkTaskExist($this->request->post("task_id"))) {
                $task = $task->fetch($this->request->post("task_id"));
                $setting = new Setting();
                $data = [
                    "username" => $task->username,
                    "password" => $task->password,
                    "tgbot_chat_id" => $task->tgbot_chat_id,
                    "tgbot_token" => $task->tgbot_token,
                    "wxpusher_uid" => $task->wxpusher_uid,
                    "webdriver_url" => $setting->getSetting("webdriver_url"),
                ];
                return json(["code" => 200, "msg" => "ok", "data" => $data]);
            } else {
                return json(["code" => 404, "msg" => "任务不存在"]);
            }
        }
        return json(["code" => 404, "msg" => "缺少任务id"]);
    }
}
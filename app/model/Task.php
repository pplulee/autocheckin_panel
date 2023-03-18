<?php
declare (strict_types=1);

namespace app\model;

use think\Model;

/**
 * @mixin Model
 */
class Task extends Model
{
    protected $table = 'tasks';
    protected $pk = 'id';

    public function fetchAll()
    {
        return $this->select();
    }

    public function numOfTasks()
    {
        return $this->count();
    }

    public function fetchByUser($userid): Task
    {
        $task = $this->where('userid', $userid)->find();
        if (!$task) {
            $task = new Task();
            $task->id = -1;
            $task->username = "";
            $task->password = "";
            $task->tgbot_chat_id = "";
            $task->tgbot_token = "";
            $task->wxpusher_uid = "";
        }
        return $task;
    }

    public function updateTask($id, $data): int
    {
        $task = $this->fetch($id);
        if ($task) {
            $task->delete();
        }
        $new_id = $this->add($data);
        return $new_id;
    }

    public function fetch($id)
    {
        $task = $this->where('id', $id)->find();
        return $task;
    }

    public function add($data): int
    {
        $task = new Task();
        $username = $data['username'];
        $password = $data['password'];
        $tgbot_chat_id = $data['tgbot_chat_id'];
        $tgbot_token = $data['tgbot_token'];
        $wxpusher_uid = $data['wxpusher_uid'];
        $userid = $data['userid'];
        $task = $task->create(['username' => $username,
            'password' => $password,
            'tgbot_chat_id' => $tgbot_chat_id,
            'tgbot_token' => $tgbot_token,
            'wxpusher_uid' => $wxpusher_uid,
            'userid' => $userid]);
        return $task->id;
    }

    public function deleteTask($id): bool
    {
        $task = $this->fetch($id);
        if ($task) {
            $task->delete();
        }
        return true;
    }

    public function checkTaskExist($id): bool
    {
        $task = $this->fetch($id);
        if ($task) {
            return true;
        }
        return false;
    }
}

<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

/**
 * @mixin \think\Model
 */
class Task extends Model
{
    protected $table = 'tasks';
    protected $pk = 'id';

    public function fetch($id)
    {
        $task = $this->where('id', $id)->find();
        if ($task) {
            return $task;
        }
        return null;
    }

    public function addTask($data): bool
    {
        $task = new Task();
        $username = $data['username'];
        $password = $data['password'];
        $tgbot_userid = $data['tgbot_chat_id'];
        $tgbot_token = $data['tgbot_token'];
        $wxpusher_uid = $data['wxpusher_uid'];
        $userid = $data['userid'];
        $task->save(['username' => $username,
                     'password' => $password,
                     'tgbot_chat_id' => $tgbot_userid,
                     'tgbot_token' => $tgbot_token,
                     'wxpusher_uid' => $wxpusher_uid,
                     'userid' => $userid]);
        return true;
    }

    public function updateTask($id,$data): bool
    {
        // check task exist
        $task = $this->fetch($id);
        if (!$task) {
            return false;
        } else {
            $username = $data['username'];
            $password = $data['password'];
            $tgbot_userid = $data['tgbot_chat_id'];
            $tgbot_token = $data['tgbot_token'];
            $wxpusher_uid = $data['wxpusher_uid'];
            $userid = $data['userid'];
            $task->update(['username' => $username,
                           'password' => $password,
                           'tgbot_chat_id' => $tgbot_userid,
                           'tgbot_token' => $tgbot_token,
                           'wxpusher_uid' => $wxpusher_uid,
                           'userid' => $userid]);
            return true;
        }
    }

    public function deleteTask($id): bool
    {
        // check task exist
        $task = $this->fetch($id);
        if (!$task) {
            return false;
        } else {
            $task->delete();
            return true;
        }
    }
}

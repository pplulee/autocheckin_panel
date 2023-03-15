<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\Task;
use app\model\User;
use think\facade\Session;

class UserController extends BaseController
{
    public function index()
    {
        $user = new User();
        $user = $user->fetch(Session::get('user_id'));
        if (!$user) {
            return alert("error", "用户不存在", "2000", "/index");
        }
        return view('/user/index', ['user' => $user]);
    }

    public function login()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $user = new User();
        if ($this->request->post('login')) {
            $user = $user->login($email, $password);
            if ($user) {
                return alert("success", "登录成功", "2000", "/user/index");
            } else {
                return alert("error", "用户名或密码错误", "2000", "/index");
            }
        } else if ($this->request->post('register')) {
            $user = $user->register($email, $password);
            if ($user) {
                return alert("success", "注册成功", "2000", "/index");
            } else {
                return alert("error", "用户已存在", "2000", "/index");
            }
        } else {
            return alert("error", "未知错误", "2000", "/index");
        }
    }


    public function logout()
    {
        Session::delete('user_id');
        return alert("success", "登出成功", "2000", "/index");
    }

    public function update()
    {
        if (!$this->request->post('email'))
            return alert("error", "邮箱不能为空", "2000", "/user/index");
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $user = new User();
        $user = $user->fetch(Session::get('user_id'));
        $user->updateUser(Session::get('user_id'), ['email' => $email, 'password' => $password]);
        return alert("success", "修改成功", "2000", "/user/index");
    }

    public function addTask()
    {
        if (!$this->request->post('username'))
            return alert("error", "用户名不能为空", "2000", "/user/index");
        if (!$this->request->post('password'))
            return alert("error", "密码不能为空", "2000", "/user/index");
        $username = $this->request->post('username');
        $password = $this->request->post('password');
        $tgbot_userid = $this->request->post('tgbot_chat_id');
        $tgbot_token = $this->request->post('tgbot_token');
        $wxpusher_uid = $this->request->post('wxpusher_uid');
        $userid = $this->request->post('userid');
        $task = new Task();
        $task->addTask(Session::get('id'), $username, $password, $tgbot_userid, $tgbot_token, $wxpusher_uid, $userid);
        return alert("success", "添加成功", "2000", "/user/index");
    }

    public function deleteTask()
    {
        $task = new Task();
        $task = $task->fetch(Session::get('id'));
        $task->deleteTask($this->request->post('task'));
        return alert("success", "删除成功", "2000", "/user/index");
    }

    public function updateTask()
    {
        if (!$this->request->post('username'))
            return alert("error", "用户名不能为空", "2000", "/user/index");
        if (!$this->request->post('password'))
            return alert("error", "密码不能为空", "2000", "/user/index");
        $username = $this->request->post('username');
        $password = $this->request->post('password');
        $tgbot_userid = $this->request->post('tgbot_chat_id');
        $tgbot_token = $this->request->post('tgbot_token');
        $wxpusher_uid = $this->request->post('wxpusher_uid');
        $userid = $this->request->post('userid');
        $task = new Task();
        $task = $task->fetch(Session::get('id'));
        $task->updateTask(Session::get('id'), ['username' => $username, 'password' => $password, 'tgbot_userid' => $tgbot_userid, 'tgbot_token' => $tgbot_token, 'wxpusher_uid' => $wxpusher_uid, 'userid' => $userid]);
        return alert("success", "修改成功", "2000", "/user/index");
    }
}

<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
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
}

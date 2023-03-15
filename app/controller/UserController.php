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
        if (!Session::get('user_id')) {
            return redirect('/index');
        }
        $user = new User();
        $user = $user->fetch(Session::get('user_id'));
        return view('/user/index', ['user' => $user]);
    }

    public function login()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        if ($email == null || $password == null) {
            return alert("error", "用户名或密码不能为空", "2000", "/index");
        }
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
        $email = $this->request->post('email');
        // 需要改进验证方法
//        if ($email == null) {
//            return redirect('/user/index');
//        }
        $password = $this->request->post('password');
        $user = new User();
        $user = $user->fetch(Session::get('user_id'));
        $user->updateUser(Session::get('user_id'), ['email' => $email, 'password' => $password]);
        return alert("success", "修改成功", "2000", "/user/index");
    }
}

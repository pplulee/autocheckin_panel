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
            return redirect('/user/login');
        }
        $user = new User();
        $user = $user->fetch(Session::get('user_id'));
        return view('user/index', ['user' => $user]);
    }

    public function login()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $user = new User();
        if ($this->request->post('login')) {
            $user = $user->login($email, $password);
            if ($user) {
                echo "登录成功";
                return redirect('/user/index');
            } else {
                echo "登录失败";
                return redirect('/index');
            }
        } else if ($this->request->post('register')) {
            $user = $user->register($email, $password);
            if ($user) {
                echo "注册成功";
                return redirect('/index');
            } else {
                echo "注册失败";
                return redirect('/index');
            }
        } else {
            return view('user/login');
        }
    }


    public function logout()
    {
        Session::delete('user_id');
        echo "退出成功";
        return redirect('/index');
    }

    public function update()
    {
        $email = $this->request->post('email');
        if ($email == null) {
            return redirect('/user/index');
        }
        $password = $this->request->post('password');
        $user = new User();
        $user = $user->fetch(Session::get('user_id'));
        $user->updateUser(Session::get('user_id'), ['email' => $email, 'password' => $password]);
        return redirect('/user/index');
    }
}

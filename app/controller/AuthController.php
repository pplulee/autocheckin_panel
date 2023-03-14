<?php
declare (strict_types=1);

namespace app\controller;

use app\BaseController;
use app\model\User;
use think\Db;
use think\facade\Session;
use think\Request;
use think\Response;

class AuthController extends BaseController
{
    /**
     * 显示资源列表
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * 显示创建资源表单页.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param Request $request
     * @return Response
     */
    public function save(Request $request)
    {
        //
    }

    /**
     * 显示指定的资源
     *
     * @param int $id
     * @return Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * 保存更新的资源
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param int $id
     * @return Response
     */
    public function delete($id)
    {

    }

    public function login()
    {
        $email = $this->request->post('email');
        $password = $this->request->post('password');
        $user = new User();
        $user = $user->login($email, $password);
        if ($user) {
            echo "登录成功";
            return redirect('/user/index');
        } else {
            echo "登录失败";
            return redirect('/index');
        }
    }

    public function logout()
    {
        Session::delete('user_id');
        echo "退出成功";
        return redirect('/index');
    }
}

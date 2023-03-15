<?php
declare (strict_types=1);

namespace app\middleware;

use Closure;
use think\facade\Session;
use think\Request;
use think\Response;

class Auth
{
    /**
     * 处理请求
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle($request, Closure $next)
    {
        // 是否已经登陆
        if (Session::get('user_id')) {
            return response(alert("error", "您已登录", "2000", "/user/index"));
        }
        // 是否有用户名密码或是否为空
        if (!$request->post('email') || !$request->post('password')) {
            return response(alert("error", "用户名或密码不能为空", "2000", "/index"));
        }
        // 是否有登录或注册
        if ($request->post('login') xor $request->post('register')) {
            return $next($request);
        } else {
            return response(alert("error", "未知错误", "2000", "/index"));
        }
    }
}

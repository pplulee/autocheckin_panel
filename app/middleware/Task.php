<?php
declare (strict_types=1);

namespace app\middleware;

use Closure;
use think\facade\Session;
use think\Request;
use think\Response;

class Task
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
        if (!Session::get('user_id')) {
            return response(alert("error", "请先登录", "2000", "/index"));
        }
        // 是否有用户名密码或是否为空
        if (!$request->post('username') || !$request->post('password')) {
            return response(alert("error", "用户名或密码不能为空", "2000", "/user/index#checkin"));
        }
        // 是否设置操作
        if ($request->post('update') xor $request->post('delete')) {
            return $next($request);
        } else {
            return response(alert("error", "未知操作", "2000", "/user/index#checkin"));
        }
    }
}

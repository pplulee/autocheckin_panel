<?php
declare (strict_types=1);

namespace app\middleware;

use app\model\User;
use Closure;
use think\facade\Session;
use think\Request;
use think\Response;

class Admin
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
        if (!Session::get('user_id')) {
            return response(alert("error", "请先登录", "2000", "/index"));
        } else {
            $user = new User();
            $user = $user->fetch(Session::get('user_id'));
            if (!$user) {
                return response(alert("error", "用户不存在", "2000", "/index"));
            }
            if ($user->admin) {
                return $next($request);
            } else {
                return response(alert("error", "您不是管理员", "2000", "/user/index"));
            }
        }
    }
}

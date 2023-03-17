<?php
declare (strict_types=1);

namespace app\middleware;

use app\model\Setting;
use Closure;
use think\Request;
use think\Response\Json;

class Api
{
    /**
     * 处理请求
     *
     * @param Request $request
     * @param Closure $next
     * @return Json
     */
    public function handle($request, Closure $next)
    {
        if (!$request->isPost()) {
            return json(["code" => 403, "msg" => "请求方式错误"]);
        }
        $key = $request->header('key');
        if (!$key || $key == "") {
            return json(["code" => 403, "msg" => "缺少key"]);
        }
        $setting = new Setting();
        $web_key = $setting->getSetting("web_key");
        if ($key != $web_key) {
            return json(["code" => 403, "msg" => "key错误"]);
        } else {
            return $next($request);
        }
    }
}

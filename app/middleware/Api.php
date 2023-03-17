<?php
declare (strict_types=1);

namespace app\middleware;

use Closure;
use think\Request;
use think\Response\Json;
use app\model\Setting;

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
        $headers = $request->header();
        foreach ($headers as $k => $value) {
            if ($k == "key") {
                $key = $value;
                $setting = new Setting();
                $web_key = $setting->getSetting("web_key");
                if ($key == $web_key) {
                    return $next($request);
                }
                return json(["code" => 403, "msg" => "key错误"]);
            }
        }
        return json(["code" => 403, "msg" => "缺少key"]);
    }
}

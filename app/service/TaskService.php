<?php
declare (strict_types=1);

namespace app\service;

use Exception;
use think\Service;

class TaskService extends Service
{
    public function register(): void
    {
        $this->app->bind('taskService', TaskService::class);
    }

    public function backendSetTask($id): array
    {
        $backendUrl = env('backend_url');
        $backendToken = env('backend_token');
        return $this->setCurl($backendUrl, $backendToken, "setTask", $id);
    }

    public function setCurl(string $backendUrl, string $backendToken, $operation, $id): array
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $backendUrl . "/$operation");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["token: $backendToken"]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ["id" => $id]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $result = curl_exec($ch);
        $error = curl_error($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        if (!$result || $error || $httpCode != 200)
            return ["status" => "fail", "msg" => "后端接口异常"];
        else {
            try {
                $result = json_decode($result, true);
                if ($result["status"] == "fail")
                    return ["status" => "fail", "msg" => $result["msg"]];
                else
                    return ["status" => "success", "msg" => $result["msg"]];
            } catch (Exception $e) {
                return ["status" => "error", "msg" => "后端接口异常"];
            }
        }
    }

    public function backendRemoveTask($id): array
    {
        $backendUrl = env('backend_url');
        $backendToken = env('backend_token');
        return $this->setCurl($backendUrl, $backendToken, "removeTask", $id);
    }
}

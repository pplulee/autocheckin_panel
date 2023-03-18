<?php
declare (strict_types=1);

namespace app\service;

use think\Service;

class TaskService extends Service
{
    public function register(): void
    {
        $this->app->bind('taskService', TaskService::class);
    }

    public function backendSetTask($id)
    {
        $backendUrl = env('backend_url');
        $backendToken = env('backend_token');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $backendUrl . "/setTask");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ["token: $backendToken"]);
        curl_setopt($ch, CURLOPT_POSTFIELDS, ["id" => $id]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }
}

<?php
include("header.php");
if (!isset($_GET['id'])) {
    echo "未提供ID";
    exit;
} else {
    if (check_task_id_exist($_GET['id'])) {
        $currenttask = new task($_GET['id']);
        $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username,password,tgbot_chat_id,tgbot_token,wxpusher_uid FROM tasks WHERE id='{$_GET['id']}';"));
        $username = $currenttask->username;
        $password = $currenttask->password;
        $tgbot_chat_id = $currenttask->tgbot_chat_id;
        $tgbot_token = $currenttask->tgbot_token;
        $wxpusher_uid = $currenttask->wxpusher_uid;
        $webdriver = $currenttask->webdriver==""?get_setting("webdriver_url"):$currenttask->webdriver;
        $data = array(
            'status' => 'success',
            'username' => $username,
            'password' => $password,
            'tgbot_chat_id' => $tgbot_chat_id,
            'tgbot_token' => $tgbot_token,
            'wxpusher_uid' => $wxpusher_uid,
            'webdriver' => $webdriver
        );
    } else {
        $data = array(
            'status' => 'fail',
            'message' => 'ID不存在'
        );
    }
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
}
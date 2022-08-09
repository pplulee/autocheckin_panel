<?php
include("header.php");
if (!isset($_GET['id'])) {
    echo "未提供ID";
    exit;
} else {
    if (check_task_id_exist($_GET['id'])) {
        $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT username,password,tgbot_userid,tgbot_token,wxpusher_uid FROM tasks WHERE id='{$_GET['id']}';"));
        $webdriver = get_setting("webdriver_url");
        $username = $result['username'];
        $password = $result['password'];
        $tgbot_userid = $result['tgbot_userid'];
        $tgbot_token = $result['tgbot_token'];
        $wxpusher_uid = $result['wxpusher_uid'];
        $data = array(
            'status' => 'success',
            'username' => $username,
            'password' => $password,
            'tgbot_userid' => $tgbot_userid,
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
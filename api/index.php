<?php
include($_SERVER['DOCUMENT_ROOT'] . "/config.php");
include($_SERVER['DOCUMENT_ROOT'] . "/include/function.php");
include($_SERVER['DOCUMENT_ROOT'] . "/include/user.php");
include($_SERVER['DOCUMENT_ROOT'] . "/include/task.php");

$conn = @mysqli_connect($Sys_config["db_host"], $Sys_config["db_user"], $Sys_config["db_password"], $Sys_config["db_database"]);  //数据库连接
if (!$conn) {
    die("数据库连接失败：" . mysqli_connect_error());
}

if (!isset($_GET['key'])) {
    $data = array(
        'status' => 'fail',
        'message' => 'key不能为空'
    );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
} else if ($_GET['key'] != get_setting("web_key")) {
    $data = array(
        'status' => 'fail',
        'id_list' => 'key错误'
    );
    echo json_encode($data, JSON_UNESCAPED_UNICODE);
    exit;
}

switch ($_GET['action']) {
    case "get_list":
    {
        $result = mysqli_query($conn, "SELECT id FROM tasks;");
        $list = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $list[] = $row['id'];
        }
        $data = array(
            'status' => 'success',
            'id_list' => implode(",", $list)
        );
        break;
    }

    case "get_parameter":
    {
        if (!isset($_GET['id'])) {
            $data = array(
                'status' => 'fail',
                'message' => '未提供ID'
            );
        } else {
            if (check_task_id_exist($_GET['id'])) {
                $currenttask = new task($_GET['id']);
                $data = array(
                    'status' => 'success',
                    'username' => $currenttask->username,
                    'password' => $currenttask->password,
                    'tgbot_userid' => $currenttask->tgbot_userid,
                    'tgbot_token' => $currenttask->tgbot_token,
                    'wxpusher_uid' => $currenttask->wxpusher_uid,
                    'webdriver' => $currenttask->webdriver == "" ? get_setting("webdriver_url") : $currenttask->webdriver
                );
            } else {
                $data = array(
                    'status' => 'fail',
                    'message' => 'ID不存在'
                );
            }
        }
        break;
    }

    default:
    {
        $data = array(
            'status' => 'success',
            'message' => '验证成功'
        );
        break;
    }
}

echo json_encode($data, JSON_UNESCAPED_UNICODE);
update_time();

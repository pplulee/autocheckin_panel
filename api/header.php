<?php
include($_SERVER['DOCUMENT_ROOT']."/config.php");
include($_SERVER['DOCUMENT_ROOT']."/include/function.php");
include($_SERVER['DOCUMENT_ROOT']."/include/user.php");
include($_SERVER['DOCUMENT_ROOT']."/include/task.php");

$conn = @mysqli_connect($Sys_config["db_host"], $Sys_config["db_user"], $Sys_config["db_password"], $Sys_config["db_database"]);  //数据库连接
if (!$conn) {
    die("数据库连接失败：" . mysqli_connect_error());
}

if (!isset($_GET['key'])) {
    echo "未提供API key";
    exit;
} else if ($_GET['key'] != get_setting("web_key")) {
    echo "API key错误";
    exit;
}else{
    update_time();
}

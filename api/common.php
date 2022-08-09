<?php
header('Content-Type: text/html; charset=UTF-8');
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include("../include/function.php");

$conn = @mysqli_connect($Sys_config["db_host"], $Sys_config["db_user"], $Sys_config["db_password"], $Sys_config["db_database"]);  //数据库连接
if (!$conn) {
    die("数据库连接失败：" . mysqli_connect_error());
}

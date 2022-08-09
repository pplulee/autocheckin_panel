<?php
header('Content-Type: text/html; charset=UTF-8');
include $_SERVER['DOCUMENT_ROOT'] . '/config.php';
include("function.php");


//Enable error reporting
if ($Sys_config["debug"]) {
    ini_set("display_errors", "On");
    error_reporting(E_ALL);
}
$conn = @mysqli_connect($Sys_config["db_host"], $Sys_config["db_user"], $Sys_config["db_password"], $Sys_config["db_database"]);  //数据库连接
if (!$conn) {
    die("数据库连接失败：" . mysqli_connect_error());
}

//Initialize session
session_start();
if (!(isset($_SESSION["isLogin"]))) {
    $_SESSION["isLogin"] = false;
    $_SESSION["permission"] = 0;
}

include("user.php");
include("task.php");

//Initialize CSS
echo '<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.2/font/bootstrap-icons.css">
    <link href=”https://fonts.googleapis.com/icon?family=Material+Icons” rel=”stylesheet”>
</head>
';

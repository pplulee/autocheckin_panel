<?php
include("header.php");
if (isset($_GET['logout'])) {
    logout();
    echo "<script>window.location.href='index.php';</script>";
    exit();
}
$current_user=new user($_SESSION['user_id']);
echo "当前用户ID：".$current_user->user_id."<br>";
echo "当前用户邮箱：".$current_user->email."<br>";
echo "当前用户任务ID：".$current_user->task_id;
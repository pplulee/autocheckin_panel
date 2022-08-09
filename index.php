<?php
include("header.php");
if (isset($_GET['logout'])) {
    logout();
    echo "<script>window.location.href='index.php';</script>";
    exit();
}
$current_user=new user($_SESSION['user_id']);
echo "当前用户ID".$current_user->get_id();
echo "当前用户邮箱".$current_user->get_email();
echo "当前用户任务ID".$current_user->get_task_id();
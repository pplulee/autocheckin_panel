<?php
include("header.php");
if (isset($_GET['logout'])) {
    logout();
    echo "<script>window.location.href='userindex.php';</script>";
    exit();
}
$current_user = new user($_SESSION['user_id']);
?>
<div class="container" style="margin-top: 1%">
    <div class="card border-dark">
        <h4 class="card-header">用户中心</h4>
        <ul class="list-group">
            <li class="list-group-item">
                <h1>当前公告:</h1> <?php echo get_notice() ?>
            </li>
            <li class="list-group-item">
                <b>用户ID:</b> <?php echo $current_user->user_id ?>
            </li>
            <li class="list-group-item">
                <b>是否设置任务:</b> <?php echo get_user_task_id($_SESSION['user_id']) == -1 ? "未设置" : "已设置" ?>
            </li>
        </ul>
    </div>
</div>

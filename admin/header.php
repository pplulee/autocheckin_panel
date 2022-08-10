<?php
include("../include/common.php");
if (!isset($_SESSION['isLogin']) or !isadmin($_SESSION["user_id"])) {
    echo "<script>window.location.href='../index.php';</script>";
    exit;
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">管理员面板</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="../index.php">网站首页</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="user.php">用户列表</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tasks.php">任务管理</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="setting.php">网站设置</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
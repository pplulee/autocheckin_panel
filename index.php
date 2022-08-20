<?php
include "include/common.php";
?>
<!DOCTYPE HTML>
<!--
    Dimension by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html lang="zh-cn">
<head>
    <meta charset="utf-8"/>
    <meta name="keywords" content=""/>
    <meta name="description" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no"/>
    <link rel="stylesheet" href="/resources/css/main.css"/>
    <noscript>
        <link rel="stylesheet" href="/resources/css/noscript.css"/>
    </noscript>
    <link href="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.css" rel="stylesheet"/>
    <script src="https://cdn.jsdelivr.net/npm/nprogress@0.2.0/nprogress.min.js"></script>
    <title>UOM自动签到</title>
</head>

<body>

<div id="wrapper">
    <header id="header">
        <div class="logo">
            <span class="icon fa-clipboard-check"></span>
        </div>
        <div class="content">
            <div class="inner">
                <h1>UoM自动签到</h1>
                <p>UoM AutoCheckin</p>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#intro">简介</a></li>
                <li><a href="#login">登录/注册</a></li>
            </ul>
        </nav>
    </header>
    <div id="main">
        <article id="intro">
            <h2 class="major">简介</h2>
            <p>欢迎来到UoM自动签到管理系统，本项目开源于GitHub<br>Welcome to UoM AutoCheckin, this repo is open source on GitHub<br>
            ようこそUoM AutoCheckinへ、このレポはGitHubでオーペンソースです</p>
        </article>
        <article id="login">
            <?php
            if(isset($_SESSION['isLogin']) and $_SESSION['isLogin']){
                echo "<script>alert('您已登录，自动跳转到用户界面！');window.location.href='userindex.php';</script>";
            }
            ?>
            <h2 class="major">登录/注册</h2>
            <p>非学校账号 若第一次使用本站请先注册</p>
            <form action="login.php" method="post">
                <div class="field half first">
                    <label for="email">邮箱</label>
                    <input type="email" name="email" id="email" placeholder="请输入邮箱"/>
                </div>
                <div class="field half">
                    <label for="password">密码</label>
                    <input type="password" name="password" id="password" placeholder="请输入密码"/>
                </div>
                <ul class="actions">
                    <li><input type="submit" value="登录" class="primary special" name="login" /></li>
                    <li><input type="submit" value="注册" class="primary" name="register"/></li>
                </ul>
            </form>
        </article>
    </div>
    <? include "footer.php"; ?>
</div>
<div id="bg"></div>
<script src="https://cdn.jsdelivr.net/npm/jquery@1.11.3"></script>
<script src="https://cdn.jsdelivr.net/gh/ajlkn/skel@3.0.1/dist/skel.min.js"></script>
<script src="/resources/js/util.js"></script>
<script src="/resources/js/main.js"></script>
<script>
    {literal}
    $(function () {
        $(window).load(function () {
            NProgress.done();
        });
        NProgress.set(0.0);
        NProgress.configure({showSpinner: false});
        NProgress.configure({minimum: 0.4});
        NProgress.configure({easing: 'ease', speed: 1200});
        NProgress.configure({trickleSpeed: 200});
        NProgress.configure({trickleRate: 0.2, trickleSpeed: 1200});
        NProgress.inc();
        $(window).ready(function () {
            NProgress.start();
        });
    });
    {/literal}
</script>
</body>
</html>
<?php
include("header.php");
if (isset($_GET['logout'])) {
    logout();
    exit();
}
$currentuser = new user($_SESSION['user_id']);
$currenttask = new task($currentuser->task_id);
?>
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
    <title>个人中心 - UOM自动签到</title>
</head>
<body>
    <div id="wrapper">
        <header id="header">
            <div class="logo">
                <span class="icon fa-user"></span>
            </div>
            <div class="content">
                <div class="inner">
                    <h1>个人中心</h1>
                    <p>User Center</p>
                    <div>
                        <h3>公告：<b><?php echo get_notice() ?></b></h3>
                    </div>
                    <div>
                        <h3><b><?php echo get_user_task_id($_SESSION['user_id']) == -1 ? "您未设置签到任务" : "您已设置签到任务" ?></b></h3>
                    </div>
                </div>
            </div>
            <nav>
                <ul>
                    <li><a href="#checkin">管理签到</a></li>
                    <li><a href="#info">个人信息</a></li>
                    <?php if ((isset($_SESSION['user_id'])) and (isadmin($_SESSION['user_id'])))
                    echo "<li><a href='/admin'>管理面板</a></li>" ?>
                    <li><a href="userindex.php?logout">退出登录</a></li>
                </ul>
            </nav>
        </header>
        <div id="main">
            <article id="checkin">
                <h2 class="major">管理签到</h2>
                <form action="checkin_manage.php" method="post">
                    <div class="field">
                        <label for="task_id">UoM Username</label>
                        <input type='text' required class='form-control' name='username' autocomplete='off' value='<?php echo $currenttask->username; ?>'/>
                    </div>
                    <div class="field">
                        <label for="task_name">UoM Password</label>
                        <input type='password' required class='form-control' name='password' autocomplete='off'
                               value='<?php echo $currenttask->password; ?>'/>
                    </div>
                    <div class="field">
                        <label for="task_url">Telegram Chat ID</label>
                        <input type='text' class='form-control' name='tgbot_userid' autocomplete='off' placeholder='不需要请留空'
                               value='<?php echo $currenttask->tgbot_userid; ?>'>
                    </div>
                    <div class="field">
                        <label for="task_url">Telegram Bot Token</label>
                        <input type='text' class='form-control' name='tgbot_token' autocomplete='off' placeholder='不需要请留空'
                               value='<?php echo $currenttask->tgbot_token; ?>'>
                    </div>
                    <div class="field">
                        <label for="task_time">WxPusher UID</label>
                        <input type='text' class='form-control' name='wxpusher_uid' autocomplete='off' placeholder='不需要请留空'
                               value='<?php echo $currenttask->wxpusher_uid; ?>'>
                    </div>
                    <div class="field">
                        <label for="task_time">Webdriver URL</label>
                        <input type='text' class='form-control' name='webdriver' placeholder='不需要请留空' autocomplete='off'
                               value='<?php echo $currenttask->webdriver; ?>'>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="保存" class="primary" name="submit"/></li>
                        <li><input type="submit" value="删除我的任务" class="primary" name="delete"/></li>
                    </ul>
                </form>
            </article>
            <article id="info">
                <h2 class="major">个人信息</h2>
                <p>您的邮箱是：<b><?php echo $currentuser->email; ?></p></b>
                <form action="user_info.php" method="post">
                    <div class="field">
                        <label for="password">密码</label>
                        <input type='password' class='form-control' name='password' placeholder='不修改请留空'>
                    </div>
                    <ul class="actions">
                        <li><input type="submit" value="保存" class="primary" name="submit"/></li>
                    </ul>
                </form>
            </article>
        </div>
        <footer id="footer">
            <p class="copyright"><?php echo date("Y") ?> &copy; <a href="https://github.com/pplulee/autocheckin_panel" target="_blank" style="text-decoration: none;">本项目开发者</a> 版权所有 |
                <a href="https://github.com/pplulee/autocheckin_panel" rel="noopener" target="_blank">
                    <img style="vertical-align:bottom;height:1.2em;border-radius:0"
                         src="https://img.shields.io/github/stars/pplulee/autocheckin_panel?style=social">
                </a>
            </p>
        </footer>
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

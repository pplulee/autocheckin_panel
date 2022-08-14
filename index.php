<?php
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
            <span class="icon fa-rocket"></span>
        </div>
        <div class="content">
            <div class="inner">
                <h1>UOM自动签到</h1>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="#intro">简介</a></li>
                <li><a href="userindex.php">登录/注册</a></li>
            </ul>
        </nav>
    </header>
    <div id="main">
        <article id="intro">
            <h2 class="major">简介</h2>
            <p>さー、UoM Autocheckinを始めましょう！</p>
        </article>
    </div>
    <footer id="footer">
        <p class="copyright">&copy;<?php echo date("Y") ?>
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
    {
        literal
    }
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
    {
        /literal}
</script>
</body>
</html>


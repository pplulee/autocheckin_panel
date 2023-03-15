<?php
// 应用公共文件
function alert($type, $message, $delay, $dest)
{
    echo '
    <script src="/static/js/sweetalert2.all.min.js"></script>
    <link href="/static/css/sweetalert2.min.css" rel="stylesheet">
    ';
    switch ($type) {
        case "success":
            $title = "成功";
            break;
        case "error":
            $title = "错误";
            break;
        case "warning":
            $title = "警告";
            break;
        case "info":
            $title = "信息";
            break;
        case "question":
            $title = "请检查";
            break;
        default:
            $title = "";
            break;
    }
    return "<script>window.onload = function() {
            Swal.fire({
            icon: '$type',
            title: '$title',
            text: '$message',
            timer:$delay,
            showConfirmButton: false,
            timerProgressBar: true});
            setTimeout(\"javascript:location.href='$dest'\", $delay);}
            </script>";
}

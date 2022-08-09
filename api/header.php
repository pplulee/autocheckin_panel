<?php
include("../include/common.php");
if (!isset($_GET['key'])){
    echo "未提供API key";
    exit;
}else if(!check_key($_GET['key'])){
    echo "API key错误";
    exit;
}
update_time();
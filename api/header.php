<?php
include("common.php");
if (!isset($_GET['key'])) {
    echo "未提供API key";
    exit;
} else if ($_GET['key'] != get_setting("web_key")) {
    echo "API key错误";
    exit;
}
update_time();
<?php
function logout()
{
    $_SESSION['isLogin'] = false;
    unset($_SESSION['user_id']);
    exit("<script>alert('已成功注销');window.location.href='index.php';</script>");
}

function isadmin($id)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT admin FROM users WHERE id='{$id}';"))["admin"]==1;
}

function userexist($email)
{
    global $conn;
    if (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM users WHERE email='$email';")) == 0) {
        return false;
    } else {
        return true;
    }
}

function register($email, $password)
{
    global $conn;
    if (userexist($email)) {
        return array(false, "Username already exists");
    } else {
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "INSERT INTO users (email, password) VALUES ('$email', '$password');");
        return array(true, "");
    }
}

function get_id_by_email($email)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT id FROM users WHERE email='$email';"))['id'];
}

function get_time()
{
    return date('Y-m-d H:i:s');
}

function isMobile(): bool
{
    // 如果有HTTP_X_WAP_PROFILE则一定是移动设备
    if (isset($_SERVER['HTTP_X_WAP_PROFILE'])) {
        return true;
    }
    // 如果via信息含有wap则一定是移动设备,部分服务商会屏蔽该信息
    if (isset($_SERVER['HTTP_VIA'])) {
        // 找不到为flase,否则为true
        return (bool)stristr($_SERVER['HTTP_VIA'], "wap");
    }
    // 脑残法，判断手机发送的客户端标志,兼容性有待提高。其中'MicroMessenger'是电脑微信
    if (isset($_SERVER['HTTP_USER_AGENT'])) {
        $clientkeywords = array('nokia', 'sony', 'ericsson', 'mot', 'samsung', 'htc', 'sgh', 'lg', 'sharp', 'sie-', 'philips', 'panasonic', 'alcatel',
            'lenovo', 'iphone', 'ipod', 'blackberry', 'meizu', 'android', 'netfront', 'symbian', 'ucweb', 'windowsce', 'palm', 'operamini', 'operamobi',
            'openwave', 'nexusone', 'cldc', 'midp', 'wap', 'mobile', 'MicroMessenger');
        // 从HTTP_USER_AGENT中查找手机浏览器的关键字
        if (preg_match("/(" . implode('|', $clientkeywords) . ")/i", strtolower($_SERVER['HTTP_USER_AGENT']))) {
            return true;
        }
    }
    // 协议法，因为有可能不准确，放到最后判断
    if (isset ($_SERVER['HTTP_ACCEPT'])) {
        // 如果只支持wml并且不支持html那一定是移动设备
        // 如果支持wml和html但是wml在html之前则是移动设备
        if ((strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') !== false) && (strpos($_SERVER['HTTP_ACCEPT'], 'text/html') ===
                false || (strpos($_SERVER['HTTP_ACCEPT'], 'vnd.wap.wml') < strpos($_SERVER['HTTP_ACCEPT'], 'text/html')))) {
            return true;
        }
    }
    return false;
}

function email_valid($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function php_self()
{
    return substr($_SERVER['PHP_SELF'], strrpos($_SERVER['PHP_SELF'], '/') + 1);
}

function check_task_id_exist($id): bool
{
    global $conn;
    if (mysqli_num_rows(mysqli_query($conn, "SELECT id FROM tasks WHERE id='$id';")) == 0) {
        return false;
    } else {
        return true;
    }
}

function update_time()
{
    global $conn;
    mysqli_query($conn, "UPDATE setting SET content='" . get_time() . "' WHERE name='last_update';");
}

function get_setting($name)
{
    global $conn;
    return mysqli_fetch_assoc(mysqli_query($conn, "SELECT content FROM setting WHERE name='$name';"))['content'];
}

function alert($message)
{
    echo "<script>alert('{$message}');</script>";
}

<?php
include("header.php");
//If user is already login, exit this page
if (isset($_SESSION["isLogin"]) and $_SESSION["isLogin"]) {
    echo "<script>alert('你已登录!');window.location.href='index.php';</script>";
    exit;
}


function login($email, $password)
{
    global $conn;
    if (userexist($email)) {
        if (password_verify($password, mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM users WHERE email='{$email}';"))["password"])) {
            return array(true, "Success");
        } else {
            return array(false, "Wrong password");
        }
    } else {
        return array(false, "User not exist");
    }
}

function startlogin($email, $password)
{
    $result = login($email, $password);
    if ($result[0]) {
        $_SESSION['isLogin'] = true;
        $_SESSION['user_id'] = get_id_by_email($email);
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('$result[1]');window.location.href='login.php';</script>";
    }
}

//Click the login bottom
if (isset($_POST['login'])) {
    if ($_POST["email"] == null or $_POST["password"] == null) {
        echo "<script>alert('email or password cannot be empty!');window.location.href='login.php';</script>";
        exit;
    } else {
        startlogin($_POST["email"], $_POST["password"]);
    }
} elseif (isset($_POST['register'])) {
    if (!email_valid($_POST["email"])) {
        echo "<script>alert('Email is invalid!');window.location.href='login.php';</script>";
        exit;
    } elseif ($_POST["email"] == null or $_POST["password"] == null) {
        echo "<script>alert('email or password cannot be empty!');window.location.href='login.php';</script>";
        exit;
    } else {
        $feed = register($_POST["email"], $_POST["password"]);
        if (!$feed[0]) {
            echo "<script>alert('$feed[1]');window.location.href='login.php';</script>";
        } else {
            echo "<script>alert('Register successfully!');window.location.href='login.php';</script>";
        }

    }
}
?>
<html lang="zh-CN">
<head>
    <title>Login</title>
</head>
<body>
<div class="container"
     style="align-self: center; position: relative;width: <?php echo((isMobile()) ? "auto" : "30%"); ?>;margin-top: 5%">
    <div class="card border-dark">
        <h4 class="card-header bg-primary text-white text-center">登录/注册</h4>
        <div class="card-body" style="margin:0 5% 5% 5%;">
            <form action="login.php" method="post">
                <div class="input-group mb-3">
                    <span class="input-group-text" id="username_input"><i class="bi bi-envelope-fill"></i>邮箱</span>
                    <input type="email" name="email" class="form-control" aria-describedby="username_input">
                </div>
                <br>
                <div class="input-group mb-3">
                    <span class="input-group-text" id="password_input"><i class="bi bi-shield-lock-fill"></i>密码</span>
                    <input type="password" name="password" class="form-control" aria-describedby="password_input">
                </div>
                <button name="login" class="btn btn-primary" type="submit">Login</button>
                <button name="register" class="btn btn-success" type="submit">Register</button>
            </form>
            <a href='index.php' class='btn btn-secondary' style="margin-top: 10%;">返回首页</a>
        </div>
    </div>
</div>
</body>
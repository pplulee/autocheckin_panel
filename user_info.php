<?php
include("header.php");
$currentuser=new user($_SESSION['user_id']);
if (isset($_POST['submit'])){
    if ($_POST['password']!=""){
        $currentuser->change_password($_POST['password']);
        echo "<script>alert('修改成功!');window.location.href='index.php';</script>";
    }
}
?>
<div class="container" style="margin-top: 2%;width: <?php echo (isMobile()) ? "auto" : "50%"; ?>;">
    <div class='card border-dark'>
        <h4 class='card-header bg-primary text-white text-center'>个人信息</h4>
        <form action='' method='post' style="margin: 20px;">
            <div class="row">
                <div class="input-group mb-3">
                    <span class='input-group-text' id='name'>邮箱</span>
                    <input type='email' disabled class='form-control' name='username' value='<?php echo $currentuser->email; ?>'>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class='input-group-text' id='name'>密码</span>
                    <input type='text' class='form-control' name='password' placeholder='不修改请留空'>
                </div>
            </div>
            <input type='submit' class='btn btn-primary' name='submit' value='保存'>
        </form>
    </div>
</div>

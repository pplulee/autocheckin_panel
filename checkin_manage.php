<?php
include("header.php");
$currentuser = new User($_SESSION['user_id']);
$currenttask = new Task($currentuser->task_id);
if (isset($_POST['submit'])) {
    if (($_POST['username'] == "") or (($_POST['password']) == "")) {
        alert("请填写用户名和密码");
    } else {
        $currenttask->update($_POST['username'], $_POST['password'], $_POST['tgbot_userid'], $_POST['tgbot_token'], $_POST['wxpusher_uid'], $_POST['webdriver'], $_SESSION['user_id']);
        alert("任务更新成功");
        echo "<script>window.location.href='userindex.php';</script>";
        exit;
    }
}else if(isset($_POST['delete'])){
    $currenttask->delete();
    echo "<script>window.location.href='userindex.php#checkin';</script>";
    exit;
}
?>
<div class="container" style="margin-top: 2%;width: <?php echo (isMobile()) ? "auto" : "50%"; ?>;">
    <div class='card border-dark'>
        <h4 class='card-header bg-primary text-white text-center'>编辑任务</h4>
        <form action='' method='post' style="margin: 20px;">
            <div class="input-group mb-3">
                <span class='input-group-text' id='name'>UoM Username</span>
                <input type='text' required class='form-control' name='username' autocomplete='off' value='<?php echo $currenttask->username; ?>'>
            </div>
            <div class="input-group mb-3">
                <span class='input-group-text' id='name'>Password</span>
                <input type='password' required class='form-control' name='password' autocomplete='off'
                       value='<?php echo $currenttask->password; ?>'>
            </div>
            <div class="input-group mb-3">
                <span class='input-group-text' id='name'>Telegram Chat ID</span>
                <input type='text' class='form-control' name='tgbot_userid' autocomplete='off' placeholder='不需要请留空'
                       value='<?php echo $currenttask->tgbot_userid; ?>'>
            </div>
            <div class="input-group mb-3">
                <span class='input-group-text' id='name'>Telegram Bot Token</span>
                <input type='text' class='form-control' name='tgbot_token' autocomplete='off' placeholder='不需要请留空'
                       value='<?php echo $currenttask->tgbot_token; ?>'>
            </div>
            <div class="input-group mb-3">
                <span class='input-group-text' id='name'>WxPusher UID</span>
                <input type='text' class='form-control' name='wxpusher_uid' autocomplete='off' placeholder='不需要请留空'
                       value='<?php echo $currenttask->wxpusher_uid; ?>'>
            </div>
            <div class="input-group mb-3">
                <span class='input-group-text' id='name'>Webdriver URL</span>
                <input type='text' class='form-control' name='webdriver' placeholder='不需要请留空' autocomplete='off'
                       value='<?php echo $currenttask->webdriver; ?>'>
            </div>
            <input type='submit' class='btn btn-primary' name='submit' value='保存'>
            <input type='submit' class='btn btn-danger' name='delete' value='清空'>
        </form>
    </div>
</div>

<?php
include("header.php");
$currentuser = new User($_SESSION['userid']);
$currenttask = new Task($currentuser->get_task_id());
if (isset($_POST['submit'])) {
    $currenttask->update($_POST['username'], $_POST['password'], $_POST['tgbot_chat_id'], $_POST['tgbot_token'], $_POST['wxpusher_uid'], $_SESSION['userid']);
    alert("任务更新成功");
}
?>
<div class="container" style="margin-top: 2%;width: <?php echo (isMobile()) ? "auto" : "50%"; ?>;">
    <div class='card border-dark'>
        <h4 class='card-header bg-primary text-white text-center'>编辑任务</h4>
        <form action='' method='post' style="margin: 20px;">
            <div class="row">
                <div class="input-group mb-3">
                    <span class='input-group-text' id='name'>用户名</span>
                    <input type='text' class='form-control' name='username' value='<?php echo $currenttask->username; ?>'>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class='input-group-text' id='name'>密码</span>
                    <input type='text' class='form-control' name='password' value='<?php echo $currenttask->password; ?>'>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class='input-group-text' id='name'>telegram聊天ID</span>
                    <input type='text' class='form-control' name='tgbot_chat_id' placeholder='不需要请留空' value='<?php echo $currenttask->tgbot_chat_id; ?>'>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class='input-group-text' id='name'>telegram bot token</span>
                    <input type='text' class='form-control' name='tgbot_token' placeholder='不需要请留空' value='<?php echo $currenttask->tgbot_token; ?>'>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3">
                    <span class='input-group-text' id='name'>微信push uid</span>
                    <input type='text' class='form-control' name='wxpusher_uid' placeholder='不需要请留空' value='<?php echo $currenttask->wxpusher_uid; ?>'>
                </div>
            </div>
            <input type='submit' class='btn btn-primary' name='submit' value='保存'>
        </form>

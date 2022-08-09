<?php
include("header.php");
?>
<form action='' method='post' style="margin: 20px;">
    <div class="input-group mb-3">
        <span class='input-group-text' id='name'>用户名</span>
        <input type='text' class='form-control' name='username'
    </div>
    <div class="input-group mb-3">
        <span class='input-group-text' id='name'>密码</span>
        <input type='text' class='form-control' name='password'
    </div>
    <div class="input-group mb-3">
        <span class='input-group-text' id='name'>telegram聊天ID</span>
        <input type='text' class='form-control' name='tgbot_chat_id'
    </div>
    <div class="input-group mb-3">
        <span class='input-group-text' id='name'>telegram bot token</span>
        <input type='text' class='form-control' name='tgbot_token'
    </div>
    <div class="input-group mb-3">
        <span class='input-group-text' id='name'>微信push uid</span>
        <input type='text' class='form-control' name='wxpusher_uid'
    </div>
</form>
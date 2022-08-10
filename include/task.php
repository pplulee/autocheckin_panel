<?php

class task
{
    var int $task_id;
    var string $username;
    var string $password;
    var string $tgbot_chat_id;
    var string $tgbot_token;
    var string $wxpusher_uid;
    var int $user_id;
    function __construct($task_id)
    {
        global $conn;
        if (check_task_id_exist($task_id)){
            $this->task_id = $task_id;
            $result = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM tasks WHERE id = '$task_id'"));
            $this->username = $result["username"];
            $this->password = $result["password"];
            $this->tgbot_chat_id = $result["tgbot_chat_id"];
            $this->tgbot_token = $result["tgbot_token"];
            $this->wxpusher_uid = $result["wxpusher_uid"];
            $this->user_id = $result["userid"];
        }else{
            $this->username = "";
            $this->password = "";
            $this->tgbot_chat_id = "";
            $this->tgbot_token = "";
            $this->wxpusher_uid = "";
            $this->user_id = -1;
            $this->task_id = -1;
        }
    }

    function update($username, $password, $tgbot_chat_id, $tgbot_token, $wxpusher_uid, $user_id)
    {
        global $conn;
        $this->username = $username;
        $this->password = $password;
        $this->tgbot_chat_id = $tgbot_chat_id;
        $this->tgbot_token = $tgbot_token;
        $this->wxpusher_uid = $wxpusher_uid;
        $this->user_id = $user_id;
        if ($this->task_id!=-1){
            $this->delete();
        }
        mysqli_query($conn, "INSERT INTO tasks (username, password, tgbot_chat_id, tgbot_token, wxpusher_uid, userid) VALUES ('$this->username', '$this->password', '$this->tgbot_chat_id', '$this->tgbot_token', '$this->wxpusher_uid', '$this->user_id');");
        $this->task_id = mysqli_insert_id($conn);
    }

    function delete()
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM tasks WHERE id = '$this->task_id'");
        $this->task_id = -1;
    }
}
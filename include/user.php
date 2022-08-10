<?php

class user
{
    var int $user_id;
    var string $email;
    var int $task_id;
    var int $is_admin;
    function __construct($user_id)
    {
        global $conn;
        $result = mysqli_query($conn, "SELECT email FROM users WHERE id='{$user_id}';");
        if (mysqli_num_rows($result) == 0) {
            $this->user_id = -1;
        } else {
            $result = mysqli_fetch_assoc($result);
            $this->user_id = $user_id;
            $this->email = $result['email'];
            $this->is_admin = isadmin($this->user_id);
            $result = mysqli_query($conn, "SELECT id FROM tasks WHERE userid='{$this->user_id}';");
            if (mysqli_num_rows($result) == 0) {
                $this->task_id = -1;
            } else {
                $this->task_id = mysqli_fetch_assoc($result)['id'];
            }
        }
    }

    function update($email,$isadmin)
    {
        global $conn;
        $this->email = $email;
        $this->is_admin = $isadmin;
        mysqli_query($conn, "UPDATE users SET email='{$this->email}',admin='{$this->is_admin}' WHERE id='{$this->user_id}';");
    }

    function change_password($password)
    {
        global $conn;
        $password = password_hash($password, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$password' WHERE id='{$this->user_id}';");
    }

    function delete_account()
    {
        global $conn;
        mysqli_query($conn, "DELETE FROM tasks WHERE userid='{$this->user_id}';");
        mysqli_query($conn, "DELETE FROM users WHERE id='{$this->user_id}';");
    }
}
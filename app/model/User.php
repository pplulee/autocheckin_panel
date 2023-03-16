<?php
declare (strict_types=1);

namespace app\model;

use think\facade\Db;
use think\facade\Session;
use think\Model;

/**
 * @mixin Model
 */
class User extends Model
{
    protected $table = 'users';
    protected $pk = 'id';

    private bool $is_admin = false;

    public function login($email, $password)
    {
        $user = $this->where('email', $email)->find();
        if ($user) {
            if (password_verify($password, $user->password)) {
                Session::set('user_id', $user->id);
                return $user;
            }
        }
        return null;
    }

    public function register($email, $password)
    {
        $user = $this->where('email', $email)->find();
        if ($user) {
            return false;
        }
        $user = new User();
        $password = password_hash($password, PASSWORD_DEFAULT);
        $user->save(['email' => $email, 'password' => $password]);
        return $user;
    }

    public function updateUser($data): bool
    {
        $id = $data['id'];
        $email = $data['email'];
        $password = $data['password'];
        $admin = $data['admin'];
        // 如果已经设置信息，则不再查询数据库
        if (!$this) {
            $user = new User();
            $user = $user->fetch($id);
        } else {
            $user = $this;
        }
        echo $this;
        if (!$user) {
            return false;
        } else {
            $update = [];
            if ($password != null) {
                $update['password'] = password_hash($password, PASSWORD_DEFAULT);
            }
            if ($user->email != $email) {
                $update['email'] = $email;
            }
            if ($user->admin != $admin) {
                $update['admin'] = $admin;
            }
            if (count($update) > 0) {
                $user->update($update, ['id' => $id]);
            }
            return true;
        }
    }

    public function deleteUser($id)
    {
        $user = new User();
        $user = $user->fetch($id);
        if (!$user) {
            return false;
        } else {
            $task = new Task();
            $task = $task->fetchByUser($id);
            if ($task) {
                $task->delete();
            }
            return $user->delete();
        }
    }

    public function fetch($id)
    {
        $user = $this->where('id', $id)->find();
        return $user;
    }

    public function fetchAll()
    {
        $users = $this->select();
        return $users;
    }

    function isAdmin($user_id)
    {
        $user = $this->fetch($user_id);
        return ($user && $user->admin);
    }

    function numOfUsers()
    {
        return $this->count();
    }

    function MySQLVersion()
    {
        $version = Db::query('select VERSION() as version');
        $version = $version[0]['version'];
        return empty($version) ? L('Unknown') : $version;
    }
}

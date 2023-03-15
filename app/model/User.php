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

    public function updateUser($id, $data): bool
    {
        // check user exist
        $user = $this->fetch($id);
        if (!$user) {
            return false;
        } else {
            $email = $data['email'];
            $password = $data['password'];
            if ($password != null) {
                $user->update(['password' => password_hash($password, PASSWORD_DEFAULT)]);
            }
            if ($user->email != $email) {
                $user->update(['email' => $email]);
            }
            return true;
        }
    }

    public function fetch($id)
    {
        $user = $this->where('id', $id)->find();
        return $user;
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

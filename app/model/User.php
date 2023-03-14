<?php
declare (strict_types = 1);

namespace app\model;

use think\facade\Session;
use think\Model;

/**
 * @mixin \think\Model
 */
class User extends Model
{
    protected $table = 'users';
    protected $pk = 'id';

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

    public function fetch($id)
    {
        $user = $this->where('id', $id)->find();
        if ($user) {
            return $user;
        }
        return null;
    }

    public function updateUser($id,$data): bool
    {
        // check user exist
        $user = $this->where('id', $id)->find();
        if (!$user) {
            return false;
        }else{
            $email = $data['email'];
            $password = $data['password'];
            if ($password != null){
                $user->update(['password' => password_hash($password, PASSWORD_DEFAULT)]);
            }
            if ($user->email != $email){
                $user->update(['email' => $email]);
            }
            return true;
        }
    }
}

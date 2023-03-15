<?php
declare (strict_types = 1);

namespace app\model;

use think\Model;

class Setting extends Model
{
    protected $table = 'setting';
    protected $pk = 'id';

    public function getLastUpdate()
    {
        $setting = $this->where('name', 'last_update')->find();
        if ($setting) {
            return $setting->content;
        } else {
            return null;
        }
    }

    public function setSetting($key, $value)
    {
        $setting = $this->where('name', $key)->find();
        if ($setting) {
            $setting->update(['content' => $value]);
        } else {
            $setting = new Setting();
            $setting->save(['name' => $key, 'content' => $value]);
        }
    }

    public function getNotice()
    {
        $setting = $this->where('name', 'notice')->find();
        if ($setting) {
            return $setting->content;
        } else {
            return null;
        }
    }
}
<?php
declare (strict_types=1);

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

    public function getSetting($key)
    {
        $setting = $this->where('name', $key)->find();
        if ($setting) {
            return $setting->content;
        } else {
            return null;
        }
    }

    public function getAllSetting()
    {
        $setting = $this->select();
        if ($setting) {
            return $setting;
        } else {
            return null;
        }
    }

    public function updateSetting($data)
    {
        foreach ($data as $key => $value) {
            $this->setSetting($key, $value);
        }
    }

    public function setSetting($key, $value)
    {
        $setting = $this->where('name', $key)->find();
        if ($setting) {
            $setting->update(['content' => $value], ['name' => $key]);
        } else {
            $setting = new Setting();
            $setting->save(['name' => $key, 'content' => $value]);
        }
    }
}
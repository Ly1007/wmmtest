<?php
namespace app\index\model\db;

use think\Model;

class User extends Model
{
    protected $table = 't_user';

    // 获取用户信息
    public function getUserInfoByName($user_name)
    {
        $map = [
            'a' => ['=','1'],
        ];

        return $this->where($map)->find();
    }

    // 用户注册
    public function userRegister($input)
    {
        return $this->insert($input);
    }

}

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
            'user_name' => $user_name
        ];

        return $this->where($map)->find();
    }
}

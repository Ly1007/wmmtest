<?php
namespace app\index\model\db;

use think\Model;

class User extends Model
{
    protected $table = 't_user';

    // 用户注册
    public function userRegister($input)
    {
        return $this->insert($input);
    }

    // 获取用户信息
    public function getUserInfo($input)
    {
        $map =[];
        if (!empty($input['user_mobile'])) {
            $map['mobile'] = ['EQ', $input['user_mobile']];
        } else if (!empty($input['user_name'])) {
            $map['user_name'] = ['EQ', $input['user_name']];
        }

        return $this->where($map)->find();
    }

}

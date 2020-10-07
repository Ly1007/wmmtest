<?php
namespace app\index\model\db;

use think\Model;

class User extends Model
{
    protected $table = 't_user';

    // 获取用户信息
    public function getListByName($name)
    {
        $map = [
            'a' => ['=','1'],
        ];

    }
}

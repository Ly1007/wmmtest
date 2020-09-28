<?php
namespace app\index\validate;

use think\Validate;

class Account extends Validate
{
    protected $rule = [
        'user_name' => 'require|max:20',
        'user_pwd' => 'require',
    ];

    protected $message = [
        'user_name.require' => '用户名必须',
        'user_name.max' => '用户名不超过20字符',
        'user_pwd.require' => '用户密码必须',
    ];
}

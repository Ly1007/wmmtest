<?php
namespace app\index\validate;

use think\Validate;

class Account extends Validate
{
    protected $rule = [
        'user_name' => 'max:20',
        'user_pwd' => 'require',
        'user_pwd_two' => 'require',
        'user_mobile' => [
            'require',
            'max' => 11,
            'regex' => '/^13[\d]{9}$|^14[5,7]{1}\d{8}$|^15[^4]{1}\d{8}$|^17[0,6,7,8]{1}\d{8}$|^18[\d]{9}$/',
        ],
    ];

    protected $message = [
        'user_name.max' => '用户名不超过20字符',
        'user_pwd.require' => '密码必须',
        'user_pwd_two.require' => '请再次输入密码',
        'user_mobile.require' => '手机号必须',
        'user_mobile.max' => '手机号不能超过11位',
        'user_mobile.regex' => '手机号格式不正确',
    ];

    protected $scene = [
        'login'  =>  ['user_name','user_pwd'],
        'register'  =>  ['user_mobile','user_name','user_pwd','user_pwd_two'],
        'complexLogin'  =>  ['user_mobile','user_pwd','user_pwd_two'],
    ];
}

<?php
namespace app\index\validate;

use think\Validate;

class Account extends Validate
{
    protected $rule = [
        'name' => 'require|max:20',
    ];

    protected $message = [
        'name.require' => '用户名必须',
        'name.max' => '用户名不超过20字符'
    ];
}

<?php
namespace app\index\validate;

use think\Validate;

class Account extends Validate
{
    protected $rule = [
        'name' => 'require|max:20',
    ];
}

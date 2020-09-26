<?php
namespace app\index\controller;

use app\common\enum\BaseEnum;
use think\Controller;

class Index
{
    public function index()
    {

        return BaseEnum::WELCOME_GREETING;
    }
}
<?php
namespace app\index\controller;

use think\facade\Cache;

class Test
{
    public function index()
    {
        Cache::set('name','张三',3600);
        $var = Cache::get('name');

        echo $var;
    }
}

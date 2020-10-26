<?php
namespace app\index\controller;

use think\Exception;
use think\facade\Cache;
use think\Request;
use think\Session;

class Test
{
    public function index()
    {
        $cache = Cache::set('name','张三',3600);
        if ($cache) {
            echo '缓存成功';
        } else {
            echo '缓存失败';
        }
    }

    public function testCache()
    {
        $res = Cache::get('name');

        echo $res;
    }

    public function test(Request $request)
    {
        $userData = $request->userData;

        var_dump($userData);
    }

}

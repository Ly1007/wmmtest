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
        echo $request->uid;
        echo '<br>';
        $num = 0;
        try {
            echo 1 / $num;
        } catch (Exception $e) {
            echo $e->getMessage();
            echo "<br>";
            echo $e->getCode();
        }

    }

}

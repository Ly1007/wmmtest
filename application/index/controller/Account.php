<?php
namespace app\index\controller;

use think\Request;

class Account
{
    // 用户登录
    public function login(Request $request)
    {
        $post = $request->post();
        $name = $post['user_name'];
        $pwd = $post['user_pwd'];

    }
}

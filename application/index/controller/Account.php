<?php
namespace app\index\controller;

use think\Request;
use app\index\validate\Account as AccountValidate;
use app\common\enum\BaseStatusCodeEnum;
use app\index\model\logic\AccountLogic;

class Account
{
    // 用户登录
    public function login(Request $request, AccountLogic $accountLogic)
    {
        // 参数
        $post = $request->post();
        // 校验数据
        $accountValidate = new AccountValidate();
        if (!$accountValidate->check($post)) {
            return sys_response(4000003,$accountValidate->getError());
        }

        $user_name = $post['user_name'];
        $user_pwd = $post['user_pwd'];

        // 根据用户名查询用户数据
        $data = $accountLogic->getUserInfoByName($user_name);
        if (empty($data)) {
            return sys_response(4000001);
        }

        // 比较数据
        if ($user_pwd != $data['pwd']) {
            return sys_response(4000004);
        }

        return $data;
    }
}

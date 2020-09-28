<?php
namespace app\index\controller;

use think\Request;
use app\index\validate\Account as AccountValidate;
use app\common\enum\BaseStatusEnum;
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
            return sys_response(4000003,BaseStatusEnum::CODE_4000003);
        }

        $name = $post['user_name'];
        $pwd = $post['user_pwd'];

        // 根据用户名查询用户数据
        $data = $accountLogic->getUserInfoByName($name);

    }
}

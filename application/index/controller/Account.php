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
        if (!$accountValidate->scene('login')->check($post)) {
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

        $response = sys_response(0, "", [
            "list" => $data
        ]);

        return json($response);
    }

    // 用户注册
    public function register(Request $request, AccountLogic $accountLogic)
    {
        $post = $request->post();

        $accountValidate = new AccountValidate();
        if (!$accountValidate->scene('register')->check($post)) {
            return sys_response(4000003, $accountValidate->getError());
        }
        // 判断两次输入密码是否一致
        if (md5($post['user_pwd']) != md5($post['user_pwd_two'])) {
            return sys_response(4000005);
        }
        // 查看用户是否注册过
        $data = $accountLogic->getUserInfoByName($post['user_name']);
        if (!empty($data)) {
            return sys_response(4000006);
        }
        // 用户注册
        $input['user_name'] = $post['user_name'];
        $input['pwd'] = md5($post['user_pwd']);
        $res = $accountLogic->userRegister($input);

        if ($res == true) {
            return sys_response(0,'用户注册成功');
        } else {
            return sys_response(5000002);
        }
    }

}

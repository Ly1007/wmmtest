<?php
namespace app\index\controller;

use app\index\model\logic\LogAccountLogic;
use think\Request;
use app\index\validate\Account as AccountValidate;
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

        // 根据用户名查询用户数据
        $data = $accountLogic->getUserInfo($post);
        if (empty($data)) {
            return sys_response(4000007);
        }
        // 比较数据
        $user_pwd = $post['user_pwd'];
        if (!password_verify($user_pwd, $data['pwd'])) {
            return sys_response(4000004);
        }

        // 生成登录日志
        $logAccountLogic = new LogAccountLogic();
        $logAccountLogic->addAccountLog($data, 1, '用户登录成功', $request->ip());

        return sys_response(0,'用户登录成功');
    }

    // 用户注册
    public function register(Request $request, AccountLogic $accountLogic)
    {
        $post = $request->post();
        // 参数验证
        $accountValidate = new AccountValidate();
        if (!$accountValidate->scene('register')->check($post)) {
            return sys_response(4000003, $accountValidate->getError());
        }
        // 判断两次输入密码是否一致
        if (md5($post['user_pwd']) != md5($post['user_pwd_two'])) {
            return sys_response(4000005);
        }

        // 查看用户是否注册过
        $data = $accountLogic->getUserInfo($post);
        if (!empty($data)) {
            return sys_response(4000006);
        }

        // 用户注册
        $res = $accountLogic->userRegister($post);

        if ($res == true) {
            return sys_response(0,'用户注册成功');
        } else {
            return sys_response(5000002);
        }
    }

    // 修改密码
    public function changePwd(Request $request, AccountLogic $accountLogic)
    {
        $post = $request->post();
        // 参数验证
        $accountValidate = new AccountValidate();
        if (!$accountValidate->scene('changePwd')->check($post)) {
            return sys_response(4000003, $accountValidate->getError());
        }

        // 判断两次新密码是否一致
        if ($post['user_pwd_new'] != $post['user_pwd_new_two']) {
            return sys_response(4000005);
        }
        // 判断新密码是否与老密码一致
        if ($post['user_pwd_new'] == $post['user_pwd']) {
            return sys_response(4000008);
        }

        // 修改密码
        $res = $accountLogic->changePwd($post);

        return $res;
    }

}

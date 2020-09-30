<?php
namespace app\index\model\logic;

use app\index\model\db\User as UserModel;

class AccountLogic
{
    /**
     * 根据用户名获取用户信息
     * @param string $user_name 用户姓名
     * @return array $data 用户信息
     */
    public function getUserInfoByName($user_name)
    {
        $userModel = new UserModel();
        $data = $userModel->getUserInfoByName($user_name);
        // logic层做返回数据的处理
        if (!empty($data)) {
            $data['address'] = !empty($data['address']) ? $data['address'] : '';
        }

        return $data;
    }

    /**
     * 用户注册
     * @param array $input 用户注册数据
     * @return int 注册成功失败信息
     */
    public function userRegister($input)
    {
        $userModel = new UserModel();
        return $userModel->userRegister($input);
    }

}

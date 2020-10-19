<?php
namespace app\index\model\logic;

use app\index\model\db\User as UserModel;

class AccountLogic
{
    /**
     * 获取用户信息
     * @param string $input
     * @return array $data 用户信息
     */
    public function getUserInfo($input)
    {
        $userModel = new UserModel();
        $data = $userModel->getUserInfo($input);
        // logic层做返回数据的处理
        if (!empty($data)) {
            $data = $data->toArray();
            $data['address'] = !empty($data['address']) ? $data['address'] : '';
            $data['free_chance'] = !empty($data['free_chance']) ?? '';
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
        $data['name'] = $input['user_name'];
        $data['tel'] = $input['user_mobile'];
        $data['pwd'] = password_hash($input['user_pwd'], PASSWORD_DEFAULT);
        $data['create_time'] = time();

        $userModel = new UserModel();
        return $userModel->userRegister($data);
    }

}

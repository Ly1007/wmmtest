<?php
namespace app\index\model\logic;

use app\index\model\db\User as UserModel;

class AccountLogic
{
    /**
     * 根据用户名获取用户信息
     * @param string $name 用户姓名
     */
    public function getUserInfoByName($user_name)
    {
        $userModel = new UserModel();
        $data = $userModel->getUserInfoByName($user_name);
        // logic层做返回数据的处理

        return $data;
    }

}

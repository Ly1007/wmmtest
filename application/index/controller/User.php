<?php
namespace app\index\controller;

use app\index\model\logic\UserLogic;
use think\Request;

class User
{
    // 查询用户信息
    public function getinfo()
    {
        $userLogic = new UserLogic();
    }

    // 用户列表
    public function getList(Request $request)
    {
        $input = $request->get();
        $page = $input['page'] ?? 1;
        $limit = $input['limit'] ?? 10;

        $userLogic = new UserLogic();
        $list = $userLogic->getUserPageList($input, $page, $limit);

        return sys_response(0, '请求成功', $list);
    }

}

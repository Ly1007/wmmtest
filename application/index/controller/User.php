<?php
namespace app\index\controller;

use app\index\model\logic\UserLogic;
use think\Request;

class User
{
    // 查询用户信息
    public function getInfo(Request $request)
    {
        $post = $request->post();
        if (empty($post['id'])) {
            return sys_response(4000002);
        }

        $userLogic = new UserLogic();
        $data = $userLogic->getUserInfo($post);
        if (empty($data)) {
            return sys_response(4000001);
        }

        return sys_response(0, '请求成功', $data);
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

    // 用户上传头像
    public function upHeadImg(Request $request)
    {
        $post = $request->file();
        $i = 0;
        $str = '';
        $d = '';
        foreach ($post as $key => $value) {
            $i++;
            if ($i!=1) {
                $d = ",";
            }
            $str .= $d.  $value;
            var_dump($value);
        }

    }

}

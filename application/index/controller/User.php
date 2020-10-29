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
        $file = $request->file('file');
        if (empty($file)) {
            return sys_response(4000002);
        }

        // 图片上传
        $res = upImg($file);
        if ($res) {
            return sys_response(0, '请求成功', $res);
        } else {
            return sys_response(0, '请求失败');
        }
    }

    // 导出用户信息
    public function exportUserInfo()
    {

    }

    protected function getCommlist($parent_id = 0,&$result = array()){
        $arr = M('comment')->where("parent_id = '".$parent_id."'")->order("create_time desc")->select();
        if(empty($arr)){
            return array();
        }
        foreach ($arr as $cm) {
            $thisArr=&$result[];
            $cm["children"] = $this->getCommlist($cm["id"],$thisArr);
            $thisArr = $cm;
        }
        return $result;
    }


}

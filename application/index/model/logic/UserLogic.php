<?php
/**
 * userLogic
 */
namespace app\index\model\logic;

use app\index\model\db\User as UserModel;
use Page\Page;

class UserLogic
{
    // 用户分页列表
    public function getUserPageList($input, $page = 1, $limit = 10)
    {
        $userModel = new UserModel();
        // 数据count
        $count = $userModel->getUserPageCount($input);
        // 分页
        $page = new Page($page, $limit, $count);
        $pageShow = $page->show();

        if ($count > 0) {
            $list = $userModel->getUserPageList($input, $page->firstRow, $page->pageSize);
        }

        return [
            'list' => $list ?? [],
            'page' => $pageShow
        ];
    }

    // 查询用户信息
    public function getUserInfo($input)
    {
        $userModel = new UserModel();

        return $userModel->getUserInfo($input);
    }

}

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

        // count
        $count = $userModel->getUserPageCount($input);
        if ($count > 0) {
            // 分页
            $page = new Page($page, $limit, $count);
            $pageShow = $page->show();
            $list = $userModel->getUserPageList($input, $pageShow->fitstRow, $pageShow->pageSize);
        }

    }

}

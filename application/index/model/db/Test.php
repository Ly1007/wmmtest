<?php
namespace app\index\model\db;

use think\Db;
use think\db\Query;

class Test
{

    // 获取多级回复
    public function getInfiniteReply($id)
    {
        $map = new Query();
        $map->where('parent_id', 'EQ', $id);

        return Db::table('mmw_comment')->where($map)->select();
    }
}

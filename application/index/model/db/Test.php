<?php
namespace app\index\model\db;

use think\Model;
use think\db\Query;

class Test extends Model
{
    protected $table = 'mmw_comment';

    public function getInfiniteReply($id)
    {
        $map = new Query();
        $map->where('parent_id', 'EQ', $id);

        return $this->where($map)->select();
    }
}

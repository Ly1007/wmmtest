<?php
namespace app\index\model\logic;

use app\index\model\db\Test;

class TestLogic
{
    // 获取多级回复
    public function getInfiniteReply($input)
    {
        $testModel = new Test();
        $data =  $testModel->getInfiniteReply($input);

        $result = [];
        if (!empty($data)) {
            // 使用Db查询不需要转为数组，本身就是数组
            // $data = $data->toArray();
            foreach ($data as $k => $v) {
                $v['children'] = $this->getInfiniteReply($v['id']);
                $result[] = $v;
            }
        }
        return $result;
    }
}

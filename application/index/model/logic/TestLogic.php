<?php
namespace app\index\model\logic;

use app\index\model\db\Test;

class TestLogic
{
    public function getInfiniteReply($input)
    {
        $testModel = new Test();

        $data =  $testModel->getInfiniteReply($input);

        $result = [];
        if (!empty($data)) {
            $data = $data->toArray();
            foreach ($data as $k => $v) {
                $v['children'] = $this->getInfiniteReply($v['id']);
                $result[] = $v;
            }
        }
        return $result;
    }
}

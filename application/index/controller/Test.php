<?php
namespace app\index\controller;

use think\facade\Cache;

class Test
{
    public function index()
    {
        $cache = Cache::set('name','张三',3600);
        if ($cache) {
            echo '缓存成功';
        } else {
            echo '缓存失败';
        }
    }

    public function testCache()
    {
        $res = Cache::get('name');

        echo $res;
    }

    public function getCard()
    {
        $companyIds = [];
        $cardModel = new CardModel();
        $cardList = $cardModel->getCardByComId($companyIds);

        if (!empty($cardList)) {
            $cardLists = [];
            foreach ($cardList as $k => $v) {
                if ($v['type'] == 1) {
                    $v['content'] = (int)$v['money1'];
                }

                $cardLists[$v['com_id']][] = $v;
            }
        }
    }
}

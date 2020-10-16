<?php
/**
 * 优惠券logic
 */
namespace app\index\model\logic;

class CardLogic
{
    public function test()
    {
        $cardList = [];
        if (!empty($cardList)) {
            $cardLists = [];
            foreach ($cardList as $k => $v) {
                if ($v['active_type'] == 1) {
                    if ($v['money1'] > 1) {
                        $v['name'] = 1;
                    } else {
                        $v['name'] =2;
                    }
                } else {
                    $v['name'] = 3;
                }
            }

            $cardLists[$v['cid']][] = $v;
        }
    }
}

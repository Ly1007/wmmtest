<?php
namespace app\index\controller;

use app\common\model\logic\ExcelLogic;

class Excel
{
    public function export()
    {
        $xlsName  = "luYuExcelTest";
        $xlsCell  = array(
            array('id','商品id'),
            array('name','姓名'),
        );
        $xlsData = [
            [
                'id' => '1',
                'name' => '小王',
            ],
            [
                'id' => '1',
                'name' => '小王',
            ]
        ];

        $excelLogic = new ExcelLogic();

        $excelLogic->exportExcel($xlsName,$xlsCell,$xlsData);;
    }

}

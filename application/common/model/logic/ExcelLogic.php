<?php
namespace app\common\model\logic;

use PHPExcel;
use PHPExcel_IOFactory;

class ExcelLogic
{
    /**
     * 导出数据
     * @param string $expTitle 文件名
     * @param array $expCellName 表头
     * @param array $expTableData 数据
     */
    public function exportExcel($expTitle,$expCellName,$expTableData)
    {
        $xlsTitle = iconv('utf-8', 'gb2312', $expTitle); // 文件名称

        $fileName = $xlsTitle . date('_YmdHis'); // or $xlsTitle 文件名称可根据自己情况设定
        $cellNum = count($expCellName);
        $dataNum = count($expTableData);

        // 引入核心文件
        $objPHPExcel = new PHPExcel();
        $cellName = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', 'AA', 'AB', 'AC', 'AD', 'AE', 'AF', 'AG', 'AH', 'AI', 'AJ', 'AK', 'AL', 'AM', 'AN', 'AO', 'AP', 'AQ', 'AR', 'AS', 'AT', 'AU', 'AV', 'AW', 'AX', 'AY', 'AZ');

        $objPHPExcel->getActiveSheet(0)->mergeCells('A1:' . $cellName[$cellNum - 1] . '1'); // 合并单元格
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', $expTitle.'  Export time:'.date('Y-m-d H:i:s'));
        for ($i = 0; $i < $cellNum; $i++) {
            $objPHPExcel->setActiveSheetIndex(0)->setCellValue($cellName[$i] . '2', $expCellName[$i][1]);
        }

        // Miscellaneous glyphs, UTF-8
        for ($i = 0; $i < $dataNum; $i++) {
            for ($j = 0; $j < $cellNum; $j++) {
                $objPHPExcel->getActiveSheet(0)->setCellValue($cellName[$j] . ($i + 3), $expTableData[$i][$expCellName[$j][0]]);
            }
        }

        header('pragma:public');
        header('Content-type:application/vnd.ms-excel;charset=utf-8;name="' . $xlsTitle . '.xls"');
        header("Content-Disposition:attachment;filename=$fileName.xls");//attachment新窗口打印inline本窗口打印
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
        exit;
    }

    // 导入
    public function import($filename)
    {
        set_time_limit(0);
        ini_set("memory_limit", "1024M");
        //$PHPExcel = new \PHPExcel();
        //文件格式
        $exts = strtolower( pathinfo($filename, PATHINFO_EXTENSION) );
        if ($exts == 'xls') {
            include "../vendor/phpoffice/phpexcel/Classes/PHPExcel/Reader/Excel5.php";
            $PHPReader = new \PHPExcel_Reader_Excel5();
        } else if ($exts == 'xlsx') {
            include "../vendor/phpoffice/phpexcel/Classes/PHPExcel/Reader/Excel2007.php";
            $PHPReader = new \PHPExcel_Reader_Excel2007();
        } else if ($exts == 'csv') {
            include "../vendor/phpoffice/phpexcel/Classes/PHPExcel/Reader/CSV.php";
            $PHPReader = new \PHPExcel_Reader_CSV();
        } else {
            die('文件格式不正确');
        }
        //载入文件
        $PHPExcel = $PHPReader->load($filename);
        //获取表中的第一个工作表，如果要获取第二个，把0改为1，依次类推
        $currentSheet = $PHPExcel->getSheet(0);
        //获取总列数
        $allColumn = $currentSheet->getHighestColumn();
        //获取总行数
        $allRow = $currentSheet->getHighestRow();
        //循环获取表中的数据，$currentRow表示当前行，从哪行开始读取数据，索引值从0开始
        $data = [];
        //从哪列开始，2表示第2行
        for ($currentRow = 2; $currentRow <= $allRow; $currentRow++) {
            //从哪列开始，A表示第一列
            for ($currentColumn = 'A'; $currentColumn <= $allColumn; $currentColumn++) {
                //数据坐标
                $address = $currentColumn . $currentRow;
                if($currentRow > $allRow){
                    if($currentColumn == 'A'){
                        $data[$currentRow]["phonecard_number"] =  \PHPExcel_Shared_Date::ExcelToPHP($currentSheet->getCell($address)->getValue());
                    }else if($currentColumn == 'B'){
                        $data[$currentRow]["phonecard_refill"] =  \PHPExcel_Shared_Date::ExcelToPHP($currentSheet->getCell($address)->getValue());
                    }else if($currentColumn == 'C'){
                        //Excel 已经帮我们内置了一些处理时间格式的方法的
                        $data[$currentRow]["recharge_time"] = (string)$this->excelTime(  \PHPExcel_Shared_Date::ExcelToPHP($currentSheet->getCell($address)->getValue()));

                    }else if($currentColumn == 'D'){
                        $data[$currentRow]["rechargeable_person"] =  \PHPExcel_Shared_Date::ExcelToPHP($currentSheet->getCell($address)->getValue());
                    }
                }else{
                    //读取到的数据，保存到数组$arr中
                    if($currentColumn == 'A'){
                        $data[$currentRow]["phonecard_number"] = $currentSheet->getCell($address)->getValue();
                    }else if($currentColumn == 'B'){
                        $data[$currentRow]["phonecard_refill"] = $currentSheet->getCell($address)->getValue();
                    }else if($currentColumn == 'C'){

                        $data[$currentRow]["recharge_time"] =(string)$this->excelTime( $currentSheet->getCell($address)->getValue());
                    }else if($currentColumn == 'D'){
                        $data[$currentRow]["rechargeable_person"] = $currentSheet->getCell($address)->getValue();
                    }
                }
            }
        }
        /*$phonecardrefill = new PhonecardRefill();
        $phonecardrefill->saveAll($data);*/
        Db::name('phonecard_refill')->insertAll($data);
    }
}

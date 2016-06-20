<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/16
 * Time: 16:20
 */

/**
 * 主要用来封装一些方法实现 excel 的一些简单操作
 * Class MeExcel
 */

//>>定义常量用于引入文件
if (!defined('PHP_EXCEL_ROOT_PATH')) {
    define('PHP_EXCEL_ROOT_PATH', dirname(__FILE__) . '/');
}
//>>引入phpExcel  主类文件
require PHP_EXCEL_ROOT_PATH . 'Classes/PHPExcel.php';
//>>引入2007文件，用于输出xlsx格式表格
require PHP_EXCEL_ROOT_PATH . 'Classes/PHPExcel/Writer/Excel2007.php';

class MeExcel
{
    public function write()
    {
        //创建人
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()->setCreator("vslinks");
        //最后修改人
        $objPHPExcel->getProperties()->setLastModifiedBy("wan yunshan");
        //标题
        $objPHPExcel->getProperties()->setTitle("this is a test");
        //题目
        $objPHPExcel->getProperties()->setSubject("xls  test");
        //描述
        $objPHPExcel->getProperties()->setDescription("this wan a test");
        //关键字
        $objPHPExcel->getProperties()->setKeywords("php excel");
        //种类
        $objPHPExcel->getProperties()->setCategory("Test result file");
        //也可用下面这种方式
        /*   $objPHPExcel->getProperties()->setCreator("ctos")
               ->setLastModifiedBy("ctos")
               ->setTitle("Office 2007 XLSX Test Document")
               ->setSubject("Office 2007 XLSX Test Document")
               ->setDescription("Test document for Office 2007 XLSX, generated using PHP classes.")
               ->setKeywords("office 2007 openxml php")
               ->setCategory("Test result file");*/
        //设置当前的sheet
        $objPHPExcel->setActiveSheetIndex(0);

        //设置sheet的标题
        $objPHPExcel->getActiveSheet()->setTitle('测试');

        //设置单元格宽度
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(20);

        //设置单元格高度
        $i = 1.5;
        $objPHPExcel->getActiveSheet()->getRowDimension($i)->setRowHeight(40);

        //合并单元格
//        $objPHPExcel->getActiveSheet()->mergeCells('A18:E22');

        //拆分单元格
//        $objPHPExcel->getActiveSheet()->unmergeCells('A28:B28');

        //设置保护cell,保护工作表
//        $objPHPExcel->getActiveSheet()->getProtection()->setSheet(true);
//        $objPHPExcel->getActiveSheet()->protectCells('A3:E13', 'PHPExcel');

        //设置格式
//        $objPHPExcel->getActiveSheet()->getStyle('E4')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_CURRENCY_EUR_SIMPLE);
//        $objPHPExcel->getActiveSheet()->duplicateStyle($objPHPExcel->getActiveSheet()->getStyle('E4'), 'E5:E13');

        //设置加粗
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->getFont()->setBold(true);

        //设置水平对齐方式（HORIZONTAL_RIGHT，HORIZONTAL_LEFT，HORIZONTAL_CENTER，HORIZONTAL_JUSTIFY）
        $objPHPExcel->getActiveSheet()->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //设置垂直居中
        $objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        //设置字号
        $objPHPExcel->getActiveSheet()->getDefaultStyle()->getFont()->setSize(10);

        //设置边框
//        $objPHPExcel->getActiveSheet()->getStyle('A1:I20')->getBorders()->getAllBorders()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

        //设置边框颜色
        /*       $objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getLeft()->getColor()->setARGB('FF993300');
               $objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getTop()->getColor()->setARGB('FF993300');
               $objPHPExcel->getActiveSheet()->getStyle('D13')->getBorders()->getBottom()->getColor()->setARGB('FF993300');
               $objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getTop()->getColor()->setARGB('FF993300');
               $objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getBottom()->getColor()->setARGB('FF993300');
               $objPHPExcel->getActiveSheet()->getStyle('E13')->getBorders()->getRight()->getColor()->setARGB('FF993300');*/


        //插入图像
//        $objDrawing = new PHPExcel_Worksheet_Drawing();

        /*设置图片路径 切记：只能是本地图片*/
//        $objDrawing->setPath('图像地址');

        /*设置图片高度*/
        /*        $objDrawing->setHeight(180);//照片高度
                $objDrawing->setWidth(150); //照片宽度*/

        /*设置图片要插入的单元格*/
//        $objDrawing->setCoordinates('E2');
        /*设置图片所在单元格的格式*/
        /*        $objDrawing->setOffsetX(5);
                $objDrawing->setRotation(5);
                $objDrawing->getShadow()->setVisible(true);
                $objDrawing->getShadow()->setDirection(50);
                $objDrawing->setWorksheet($objPHPExcel->getActiveSheet());*/

        //设置单元格背景色
//        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
//        $objPHPExcel->getActiveSheet(0)->getStyle('A1')->getFill()->getStartColor()->setARGB('FFCAE8EA');
        //最后输入浏览器，导出Excel
        $savename = '导出测试';
        $ua = $_SERVER["HTTP_USER_AGENT"];
        $datetime = date('Y-m-d', time());
        if (preg_match("/MSIE/", $ua)) {
            $savename = urlencode($savename); //处理IE导出名称乱码
        }

        // excel头参数
//        var_dump(111);exit;
        //>>设计一个数据，用于模拟输出
        $rows = [
            //>>第一条就是一个记录
            ['name' => 'zhangsan','age' => '19', 'sex' => 'nan', 'height' => 1.80],
            ['name' => 'lisi','age' => '20', 'sex' => 'nan', 'height' => 1.90],
            ['name' => 'diaochan','age' => '16', 'sex' => 'nv', 'height' => 1.65],
            ['name' => 'wangwu','age' => '30', 'sex' => 'nan', 'height' => 1.60],
            ['name' => 'xishi','age' => '18', 'sex' => '', 'height' => 1.64],
        ];
        //>>循环输出
        //>>因为第一行为标题，所以从第二行开始输出
        $objPHPExcel->getActiveSheet()->setCellValue('A1' ,'姓名');
        $objPHPExcel->getActiveSheet()->setCellValue('B1' ,'年龄');
        $objPHPExcel->getActiveSheet()->setCellValue('C1' ,'性别');
        $objPHPExcel->getActiveSheet()->setCellValue('D1' ,'身高');
        foreach($rows as $i =>  $row){
            $objPHPExcel->getActiveSheet()->setCellValue('A' . ($i+2), $row['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . ($i+2), $row['age']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . ($i+2), $row['sex']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . ($i+2), $row['height']);
        }
        header("Content-Type:application/vnd.ms-execl; charset=utf8");
        header('Content-Disposition: attachment;filename="' . $savename . '.xls"');  //日期为文件名后缀
        header('Cache-Control: max-age=0');
//        echo date('H:i:s') . " Create new Worksheet object\n";
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');  //excel5为xls格式，excel2007为xlsx格式
        $objWriter->save('php://output');
//
//        var_dump(111);exit;

    }


    public function read()
    {

    }
}
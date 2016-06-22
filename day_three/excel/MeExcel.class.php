<?php

/**
 * Created by PhpStorm.
 * User: asan
 * Date: 2016/6/16
 * Time: 16:20
 */

/**
 * 可以从excel 中导入数据和图片,一个单元格只能放一张图片
 * 如果导入图片,因为数据量太大,会导致内存溢出.不建议使用.
 * 可以把从数据库取出的数据存入excel 中,不能存放图片
 *
 * 使用read 方法读取文件并转换为数组.方便存入数据库
 * 使用write 方法导出数据到excel .
 * Class MeExcel
 */

//>>定义常量用于引入文件
if (!defined('PHP_EXCEL_ROOT_PATH')) {
    define('PHP_EXCEL_ROOT_PATH', dirname(__FILE__) . '/');
}
//>>引入phpExcel  主类文件
require_once PHP_EXCEL_ROOT_PATH . 'Classes/PHPExcel.php';

class MeExcel
{
    public $error = null;

    /**
     * 传入需要下载的数据
     * @param array $rows
     */
    public function write(array $rows, $title = null)
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


        //设置水平对齐方式（HORIZONTAL_RIGHT，HORIZONTAL_LEFT，HORIZONTAL_CENTER，HORIZONTAL_JUSTIFY）
//        $objPHPExcel->getActiveSheet()->getStyle('D11')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);

        //设置垂直居中
//        $objPHPExcel->getActiveSheet()->getStyle('A18')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

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

        //最后输入浏览器，导出Excel
        $savename = '导出测试';
        $ua = $_SERVER["HTTP_USER_AGENT"];
//        $datetime = date('Y-m-d', time());
        if (preg_match("/MSIE/", $ua)) {
            $savename = urlencode($savename); //处理IE导出名称乱码
        }

        // excel头参数
        //>>循环输出
        //>>因为第一行为标题，所以从第二行开始输出
        if (is_null($title)) {
            $k = 0;
            foreach ($rows[0] as $key => $v) {
                //设置单元格背景色
                $objPHPExcel->getActiveSheet(0)->getStyle($this->alphabet($k) . '1')->getFill()->setFillType(\PHPExcel_Style_Fill::FILL_SOLID);
                $objPHPExcel->getActiveSheet(0)->getStyle($this->alphabet($k) . '1')->getFill()->getStartColor()->setARGB('FFCAE8EA');
                //设置加粗
                $objPHPExcel->getActiveSheet()->getStyle($this->alphabet($k) . '1')->getFont()->setBold(true);
                //>>设置每一列的标题
                $objPHPExcel->getActiveSheet()->setCellValue($this->alphabet($k) . '1', $key);
                ++$k;
            }
        } elseif (is_array($title)) {
            foreach ($title as $key => $v) {
                //>>设置每一列的标题
                $objPHPExcel->getActiveSheet()->setCellValue($this->alphabet($key) . '1', $v);
            }
        }

        foreach ($rows as $key => $row) {
            //>>输出数据
            $j = 0;
            foreach ($row as $val) {
                $objPHPExcel->getActiveSheet()->setCellValue($this->alphabet($j) . ($key + 2), $val);
                ++$j;
            }
        }
        //>>设定编码 ,这个很重要,要不然乱码.
        header("Content-Type:application/vnd.ms-execl; charset=utf8");
        //日期为文件名后缀
        header('Content-Disposition: attachment;filename="' . $savename . '.xls"');
        header('Cache-Control: max-age=0');
        //excel5为xls格式，excel2007为xlsx格式
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');

    }

    /**
     * @param string $file
     * @return array|bool
     */
    public function read($file)
    {
        if (!file_exists($file)) {
            $this->error = '文件不存在';
            return false;
        }
        //>>取出文件后缀

        $type = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        //根据不同类型分别操作
        if ($type == 'xlsx' || $type == 'xls') {
            $objPHPExcel = PHPExcel_IOFactory::load($file);
        } else if ($type == 'csv') {
            $objReader = PHPExcel_IOFactory::createReader('CSV')
                ->setDelimiter(',')
                ->setInputEncoding('UTF-8')//不设置将导致中文列内容返回boolean(false)或乱码
                ->setEnclosure('"')
                ->setLineEnding("\r\n")
                ->setSheetIndex(0);
            $objPHPExcel = $objReader->load($file);
        } else {
            $this->error = '不支持的文件类型!';
            return false;
        }
        //选择标签页
        $sheet = $objPHPExcel->getSheet(0);
        //获取行数与列数,注意列数需要转换
        $highestRowNum = $sheet->getHighestRow();  //>>行数
        $highestColumn = $sheet->getHighestColumn(); //>>列数
        $highestColumnNum = PHPExcel_Cell::columnIndexFromString($highestColumn);  //>>列名转换为索引
        //取得字段，这里测试表格中的第一行为数据的字段，因此先取出用来作后面数组的键名
        $filed = [];
        for ($i = 0; $i < $highestColumnNum; $i++) {
            $cellName = PHPExcel_Cell::stringFromColumnIndex($i) . '1';
            $cellVal = $sheet->getCell($cellName)->getValue();//取得列内容
            $filed [] = $cellVal;
        }

        //开始取出数据并存入数组
        $data = [];
        for ($i = 2; $i <= $highestRowNum; $i++) {    //ignore row 1
            $row = [];
            for ($j = 0; $j < $highestColumnNum; $j++) {
                $cellName = PHPExcel_Cell::stringFromColumnIndex($j) . $i;
                $cellVal = $sheet->getCell($cellName)->getValue();
                $row[$filed[$j]] = $cellVal;
            }
            //>>如果不为空才保存数据
            if (!empty($row)) {
                $data [$i] = $row;
            }
        }

        //>>检测是否有数据
        if (empty($data)) {
            $this->error = '文件中没有数据';
            return false;
        }
        //>>删除data 中所有记录均为null的记录
        foreach ($data as $key => $val) {
            $temp = false;
            foreach ($val as $k => $v) {
                if (!is_null($v)) {
                    $temp = true;
                    break;
                }
            }
            if (!$temp) {
                //>>删除所有值均为null的数据
                unset($data[$key]);
            }
        }

        //>>因为图片读取数据量太大,注释暂不使用.

/*        //>>获取图片
        $imageData = $this->gainImage($file);
        if(!empty($imageData)){
            //>>把图片数据
            foreach($data as $key => $val){
                $data[$key]['images'] = $imageData[$key];
                foreach($val as $k => $v){
                    if(is_null($v)){
                        unset($data[$key][$k]);
                    }
                }
            }
        }*/
        return $data;
    }


    /**
     * 传入一个参数输出字母
     * @param integer $i
     */
    private function alphabet($i)
    {
        $start = 65; //>>从65开始 输出大写A开始的字母
        return $str = chr($start + $i);
    }


    public function gainImage($file)
    {

        $cacheMethod = PHPExcel_CachedObjectStorageFactory::cache_in_memory_gzip;
        $cacheSettings = array();
        PHPExcel_Settings::setCacheStorageMethod($cacheMethod,$cacheSettings);

        //把导入的文件目录传入，系统会自动找到对应的解析类
        $imageExcel = PHPExcel_IOFactory::load($file);
        //选择第几个表，如下面图片，默认有三个表
        $sheet = $imageExcel->getSheet(0);
        //把表格的数据转换为数组，注意：
        //这里转换是以行号为数组的外层下标，列号会转成数字为数组内层下标，坐标对应的值只会取字符串保留在这里，图片或链接不会出现在这里。
        $data = $sheet->toArray();
        /*取图片*/
        $imgData = array();
        $imageFilePath = DEMO_PATH . 'images/' . date('Y/m/d') . '/';//图片保存目录
        if(!file_exists($imageFilePath)){
            //>>如果目录不存在,创建目录
            mkdir($imageFilePath,0777,true);
        }
        foreach ($sheet->getDrawingCollection() as $img) {
            list ($startColumn, $startRow) = PHPExcel_Cell::coordinateFromString($img->getCoordinates());//获取列与行号
            $imageFileName = $img->getCoordinates() . mt_rand(1000, 9999);
            /*表格解析后图片会以资源形式保存在对象中，可以通过getImageResource函数直接获取图片资源然后写入本地文件中*/
            switch ($img->getMimeType()) {//处理图片格式
                case 'image/jpg':
                case 'image/jpeg':
                    $imageFileName .= '.jpg';
                    imagejpeg($img->getImageResource(), $imageFilePath . $imageFileName);
                    break;
                case 'image/gif':
                    $imageFileName .= '.gif';
                    imagegif($img->getImageResource(), $imageFilePath . $imageFileName);
                    break;
                case 'image/png':
                    $imageFileName .= '.png';
                    imagepng($img->getImageResource(), $imageFilePath . $imageFileName);
                    break;
            }
            //>>补全完整图片路径
            $imageFileName = $imageFilePath . $imageFileName;
            $imgData[$startRow][$startColumn] = $imageFileName;//追加到数组中去
        }
        return $imgData;

    }
}
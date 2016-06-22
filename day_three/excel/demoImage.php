<?php
define('DEMO_PATH', dirname(__FILE__) . '/');
//>>文件路径
$file = DEMO_PATH . 'static/test09.xls';
//>>引入类文件
require DEMO_PATH . 'MeExcel.class.php';
//>>实例化
$ex = new MeExcel();
//>>读取图片数据  返回保存好的路径.一次只能读取少量图片.
$data = $ex->gainImage($file);
var_dump($data);
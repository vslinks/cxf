<?php
//>>引入类文件

define('DEMO_PATH', dirname(__FILE__) . '/');
//>>文件路径
//$file = DEMO_PATH . 'static/test09.xls';
$file = DEMO_PATH . 'static/test10.xls';
//>>读取文本数据

require DEMO_PATH . 'MeExcel.class.php';
$ex = new MeExcel();
//>>读取文件内容.
$data = $ex->read($file);

//>>读取图片数据  返回保存好的路径.一次只能读取少量图片.
//$data = $ex->gainImage($file);

var_dump(count($data));
<?php
//>>引入类文件

define('DEMO_PATH', dirname(__FILE__) . '/');
//>>文件路径
$file = DEMO_PATH . 'static/test09.xls';
//>>读取文本数据
require DEMO_PATH . 'MeExcel.class.php';
$ex = new MeExcel();
$data = $ex->read($file);

var_dump($data);
<?php
header("Content-Type: text/html;charset=utf-8");
//>>引入类文件
define('DEMO_PATH', dirname(__FILE__) . '/');
require  DEMO_PATH . 'MeExcel.class.php';
$meExcel = new MeExcel();
//>>设计的数据,使用时从数据库中取出
$rows = [
    //>>每一条就是一个记录
    ['name' => 'zhangsan','age' => '19', 'sex' => 'nan', 'height' => 1.80],
    ['name' => 'lisi','age' => '20', 'sex' => 'nan', 'height' => 1.90],
    ['name' => 'diaochan','age' => '16', 'sex' => 'nv', 'height' => 1.65],
    ['name' => 'wangwu','age' => '30', 'sex' => 'nan', 'height' => 1.60],
    ['name' => 'xishi','age' => '18', 'sex' => 'nv', 'height' => 1.64],
];
$title = null;//标题数据
//>>可以传入标题,也可以直接从取出字段
//$meExcel->write($rows,$title);
//>>文件地址
$file = DEMO_PATH . 'static/test09.xls';
$arr = $meExcel->read($file);
echo "<pre>";
var_dump($arr);

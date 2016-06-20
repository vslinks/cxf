<?php
require ('demo.class.php');
//>>配置上传的一些参数;
$config = [
    'domain' => 'maihoho.b0.upaiyun.com',  //不带http://
    'root' => '/img',  //带/如:/ipc  文件上传目录
    'username' => 'cheqin',//又拍云操作员
    'password'  => 'abc123456',  //密码
    'bucket' =>   'maihoho', //空间名称
];
//>>传入的图片可以是数组的多张图片,也可以是一张图片的路径string ;
//$imageFields = [
//    'D:/server/wamp/www/day_one/image/01.jpg',
//    'D:/server/wamp/www/day_one/image/01.jpg',
//];
$imageFields = 'D:/server/wamp/www/day_one/image/01.jpg';
//>>实例化上传图片类  传入参数
$upload = new demo($config);
$result = $upload->uplod($imageFields);
if($result === false){
    //>>上传失败
    var_dump($upload->info);
}else{
    //>>上传成功  保存图片路径
    var_dump($result);
}




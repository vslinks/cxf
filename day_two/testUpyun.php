<?php
require('UpYunUpload.class.php');
//>>需要配置的参数
$config = [
    'domain' => 'maihoho.b0.upaiyun.com',  //域名http://
    'root' => '/img',  //根目录:/ipc
    'username' => 'cheqin',//操作员名称
    'password'  => 'abc123456',  //操作员密码
    'bucket' =>   'maihoho', //空间
];
//>>上传的图片地址,可以是数组形式,也可以是单张的字符串形式 ;
//$imageFields = [
//    'D:/server/wamp/www/day_one/image/01.jpg',
//    'D:/server/wamp/www/day_one/image/01.jpg',
//];
$imageFields = 'D:/server/wamp/www/day_one/image/01.jpg';
//>>实例化上传图片类
$upload = new UpYunUpload($config);
$result = $upload->uplod($imageFields);
if($result === false){
    //>>上传失败,获取到错误信息
    var_dump($upload->info);
}else{
    //>>上传成功,返回upyun图片路径
    var_dump($result);
}




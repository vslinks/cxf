<?php
header("Content-type: text/html; charset=utf-8");
//>>引入 又拍云

require('upyunsdk/upyun.class.php');
//$yuming='v0.api.upyun.com';  //不带http://
$yuming='maihoho.b0.upaiyun.com';  //不带http://
$root = '/img';  //带/如:/ipc  文件上传目录
$username = 'cheqin2'; //又拍云操作员
$password = 'abc123456'; //又拍云密码
$bucket = 'maihoho'; //空间名称
$upyun = new UpYun($bucket,$username,$password);
$imageFile = 'D:/server/project/day_one/image/01.jpg'; //图片路径;  本地或网络
function up($url){
    try {
        global $upyun,$root,$path;
        $fh = file_get_contents($url);  //>>获取文件信息
        $md=substr(md5($url), 0, 10); //这边使用md5是防止生成相同文件名,命名方式很多 自定
        $path= $root.'/'.$md.'.jpg';  //>>生成图片路径
        $upyun->writeFile($path, $fh, True);  //>>上传图片
        return $path;

    }
    catch(Exception $info) {
        echo $info->getCode();
        echo $info->getMessage();
    }

}

/**
 *
 * @param  array | string $imgFields
 */
function upyunUpload($imgFields,$domain ){

    //>>先判断传入的是什么类型的数据
    //>>如果传入的是数组
    if(is_array($imgFields)){
        //>>循环保存图片
        $map = [];
        foreach($imgFields as $imageFile){
            up($imageFile);
            $map[] = 'http://' . $domain . $GLOBALS['path'];
        }
        return $map;
    }else{
        //>>传入的是一张图片路径
        up($imgFields);
        return 'http://' . $domain . $GLOBALS['path'];  //返回上传路径
    }

}




//>>上传图片方法使用又拍云。

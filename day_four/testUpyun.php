<?php
/**
 * @param $config
 * @param $imageFields
 * @return array|boolean|string
 */
function upyunUpload($config,$imageFields){
    if(!defined('UPYUN_PATH')){
        define('UPYUN_PATH',dirname(__FILE__ ) . DIRECTORY_SEPARATOR);
    }
    /**
     * 引入upyun类文件
     */
    require(UPYUN_PATH . 'upyun.class.php');
    //>>需要配置的参数
    $config_default = [
        'domain'   => 'maihoho.b0.upaiyun.com',     //域名不带http://
        'root'     => '/img',                       //根目录:/ipc
        'username' => 'cheqin',                     //操作员名称
        'password' => 'abc123456',                  //操作员密码
        'bucket'   => 'maihoho',                    //空间
    ];
    $config = array_merge($config_default,$config);
    //>>实例化上传图片类
    $upload = new UpYunUpload($config);
    $result = $upload->uplod($imageFields);
    if ($result === false) {
        //>>上传失败,获取到错误信息
        return $upload->info;
    } else {
        //>>上传成功,返回upyun图片路径
        return $result;
    }
}


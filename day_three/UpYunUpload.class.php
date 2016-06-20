<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/16
 * Time: 14:20
 */
//>>定义路径
if (!defined('UPYUN_ROOT')) {
    define('UPYUN_ROOT', dirname(__FILE__) . '/');
    require (UPYUN_ROOT . 'upyunsdk/upyun.class.php');
}

class UpYunUpload
{
    private  $config = [
        'domain' => 'maihoho.b0.upaiyun.com',  //域名http://
        'root' => '/img',  //根目录
        'username' => '',//操作员名称
        'password'  => 'abc123456',  //操作员密码
        'bucket' =>   'maihoho', //空间名称
    ];
    public $info = null;//>>保存错误信息
    private $upyun;   //>>保存upyun对象
    private $path;  //>>保存上传成功后的图片路径
    public function __construct(array $config)
    {

        //>>把传入的参数与默认配置参数合并
        $this->config = array_merge($this->config,$config);
        //>>取出实例化upyun对象需要的三个参数;
        $bucket = $this->config['bucket'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        //>>实例化upyun对象
        $this->upyun = new UpYun($bucket,$username,$password);
    }

    /**
     *
     * @param array|string $imgFields
     * @return array|string
     */
    public function uplod($imgFields){
        //>>判断是否传入的是多张图片路径
        if(is_array($imgFields)){
            //>>定义一个数组来封装上传成功后的多张图片路径
            $map = [];
            foreach($imgFields as $imageFile){
                $this->up($imageFile);
                $map[] = 'http://' . $this->config['domain'] . $this->path;
            }
            //>>判断是否有错误信息
            if($this->info === null){
                //>>如果没有错误信息,上传成功
                return $map;
            }
            //>>否则,上传失败
            return false;
        }
        if(is_string($imgFields)){
            //>>判断是否一张图片.
            $this->up($imgFields);
            //>>判断是否有错误信息
            if($this->info === null){
                //>>如果没有错误信息,上传成功
                //>>返回图片路径
                return 'http://' . $this->config['domain'] . $this->path;
            }
            //>>否则上传失败,
            return false;
        }
        //>>如果即不是数组,也不是字符串
        $this->info = '文件不存在';
        return false;

    }

    /**
     * @param string $url
     * @return string
     */
    private function up($url){
        try {
            $fh = file_get_contents($url);  //>>读取出需要上传的文件的数据流
            $md=substr(md5($url), 0, 10); //设计一个文件名,防止 重复
            $this->path= $this->config['root'] . '/' . $md . '.jpg';  //>>上传图片路径
            $this->upyun->writeFile($this->path, $fh, True);  //>>执行上传
            return $this->path;

        }
        catch(Exception $info) {
            //>>保存错误信息
            $arr['getCode'] = $info->getCode();
            $arr['getMessage'] = $info->getMessage();
            $this->info[] = $arr;
        }

    }


}
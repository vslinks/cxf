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

class demo
{
    private  $config = [
        'domain' => 'maihoho.b0.upaiyun.com',  //不带http://
        'root' => '/img',  //带/如:/ipc  文件上传目录
        'username' => '',//又拍云操作员
        'password'  => 'abc123456',  //密码
        'bucket' =>   'maihoho', //空间名称
    ];
    public $info = null;//>>错误信息
    private $upyun;   //>>又拍云对象
    private $path;  //>>保存生成的图片路径
    public function __construct(array $config)
    {

        //>>合并参数
        $this->config = array_merge($this->config,$config);
        //>>取出各参数;
        $bucket = $this->config['bucket'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        //>>引入sdk文件
        //>>实例化又拍云
        $this->upyun = new UpYun($bucket,$username,$password);
    }

    /**
     *
     * @param array|string $imgFields
     * @return array|string
     */
    public function uplod($imgFields){
        //>>实现 图片上传
        if(is_array($imgFields)){
            //>>循环保存图片
            $map = [];
            foreach($imgFields as $imageFile){
                $this->up($imageFile);
                $map[] = 'http://' . $this->config['domain'] . $this->path;
            }
            //>>判断是否上传成功
            if($this->info === null){
                //>>没有错误信息,上传成功
                //>>返回所有上传文件的图片路径
                return $map;
            }
            //>>有错误信息 返回错误信息
            return false;
        }
        if(is_string($imgFields)){
            //>>传入的是一张图片
            $this->up($imgFields);

            //>>判断是否上传成功
            if($this->info === null){
                //>>没有错误信息,上传成功
                //>>返回所有上传文件的图片路径
                return 'http://' . $this->config['domain'] . $this->path;  //返回上传路径
            }
            //>>有错误信息 返回错误信息
            return false;
        }
        //>>如果即不是数组 ,也不是字符串.直接返回错误
        $this->info = '请传入正确的图片路径';
        return false;

    }

    /**
     * 实现上传图片功能  如果出错,保存错误信息.
     * @param string $url
     * @return string
     */
    private function up($url){
        try {
            $fh = file_get_contents($url);  //>>获取文件信息
            $md=substr(md5($url), 0, 10); //这边使用md5是防止生成相同文件名
            $this->path= $this->config['root'] . '/' . $md . '.jpg';  //>>生成图片路径
            $this->upyun->writeFile($this->path, $fh, True);  //>>上传图片
            return $this->path;

        }
        catch(Exception $info) {
            //>>如果出错 把错误信息保存起来
            $arr['getCode'] = $info->getCode();
            $arr['getMessage'] = $info->getMessage();
            $this->info[] = $arr;
        }

    }
}
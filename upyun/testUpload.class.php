<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/20
 * Time: 13:27
 */

namespace Upyun;

use Upyun\Upyun;
class testUpload
{

    /**
     * 默认上传配置
     * @var array
     */
    private $config = array(
        'host'     => '', //又拍云服务器
        'username' => '', //又拍云用户
        'password' => '', //又拍云密码
        'bucket'   => '', //空间名称
        'timeout'  => 90, //超时时间
    );
    /**
     * 上传错误信息
     * @var string
     */
    private $error = ''; //上传错误信息

    /**
     * upyun实例
     * @var Object
     */
    private $uploader;

    /**
     * 构造方法,用于upyun构造上传实例
     */
    public function __construct($config = [])
    {
        /**
         * 获取配置
         */
        $this->config = array_merge($this->config,$config);

        $this->uploader = new Upyun($this->config);
    }
}
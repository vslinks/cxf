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
     * Ĭ���ϴ�����
     * @var array
     */
    private $config = array(
        'host'     => '', //�����Ʒ�����
        'username' => '', //�������û�
        'password' => '', //����������
        'bucket'   => '', //�ռ�����
        'timeout'  => 90, //��ʱʱ��
    );
    /**
     * �ϴ�������Ϣ
     * @var string
     */
    private $error = ''; //�ϴ�������Ϣ

    /**
     * upyunʵ��
     * @var Object
     */
    private $uploader;

    /**
     * ���췽��,����upyun�����ϴ�ʵ��
     */
    public function __construct($config = [])
    {
        /**
         * ��ȡ����
         */
        $this->config = array_merge($this->config,$config);

        $this->uploader = new Upyun($this->config);
    }
}
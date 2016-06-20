<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/6/16
 * Time: 14:20
 */
//>>����·��
if (!defined('UPYUN_ROOT')) {
    define('UPYUN_ROOT', dirname(__FILE__) . '/');
    require (UPYUN_ROOT . 'upyunsdk/upyun.class.php');
}

class demo
{
    private  $config = [
        'domain' => 'maihoho.b0.upaiyun.com',  //����http://
        'root' => '/img',  //��/��:/ipc  �ļ��ϴ�Ŀ¼
        'username' => '',//�����Ʋ���Ա
        'password'  => 'abc123456',  //����
        'bucket' =>   'maihoho', //�ռ�����
    ];
    public $info = null;//>>������Ϣ
    private $upyun;   //>>�����ƶ���
    private $path;  //>>�������ɵ�ͼƬ·��
    public function __construct(array $config)
    {

        //>>�ϲ�����
        $this->config = array_merge($this->config,$config);
        //>>ȡ��������;
        $bucket = $this->config['bucket'];
        $username = $this->config['username'];
        $password = $this->config['password'];
        //>>����sdk�ļ�
        //>>ʵ����������
        $this->upyun = new UpYun($bucket,$username,$password);
    }

    /**
     *
     * @param array|string $imgFields
     * @return array|string
     */
    public function uplod($imgFields){
        //>>ʵ�� ͼƬ�ϴ�
        if(is_array($imgFields)){
            //>>ѭ������ͼƬ
            $map = [];
            foreach($imgFields as $imageFile){
                $this->up($imageFile);
                $map[] = 'http://' . $this->config['domain'] . $this->path;
            }
            //>>�ж��Ƿ��ϴ��ɹ�
            if($this->info === null){
                //>>û�д�����Ϣ,�ϴ��ɹ�
                //>>���������ϴ��ļ���ͼƬ·��
                return $map;
            }
            //>>�д�����Ϣ ���ش�����Ϣ
            return false;
        }
        if(is_string($imgFields)){
            //>>�������һ��ͼƬ
            $this->up($imgFields);

            //>>�ж��Ƿ��ϴ��ɹ�
            if($this->info === null){
                //>>û�д�����Ϣ,�ϴ��ɹ�
                //>>���������ϴ��ļ���ͼƬ·��
                return 'http://' . $this->config['domain'] . $this->path;  //�����ϴ�·��
            }
            //>>�д�����Ϣ ���ش�����Ϣ
            return false;
        }
        //>>������������� ,Ҳ�����ַ���.ֱ�ӷ��ش���
        $this->info = '�봫����ȷ��ͼƬ·��';
        return false;

    }

    /**
     * ʵ���ϴ�ͼƬ����  �������,���������Ϣ.
     * @param string $url
     * @return string
     */
    private function up($url){
        try {
            $fh = file_get_contents($url);  //>>��ȡ�ļ���Ϣ
            $md=substr(md5($url), 0, 10); //���ʹ��md5�Ƿ�ֹ������ͬ�ļ���
            $this->path= $this->config['root'] . '/' . $md . '.jpg';  //>>����ͼƬ·��
            $this->upyun->writeFile($this->path, $fh, True);  //>>�ϴ�ͼƬ
            return $this->path;

        }
        catch(Exception $info) {
            //>>������� �Ѵ�����Ϣ��������
            $arr['getCode'] = $info->getCode();
            $arr['getMessage'] = $info->getMessage();
            $this->info[] = $arr;
        }

    }
}
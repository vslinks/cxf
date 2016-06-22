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
     * ����upyun���ļ�
     */
    require(UPYUN_PATH . 'upyun.class.php');
    //>>��Ҫ���õĲ���
    $config_default = [
        'domain'   => 'maihoho.b0.upaiyun.com',     //��������http://
        'root'     => '/img',                       //��Ŀ¼:/ipc
        'username' => 'cheqin',                     //����Ա����
        'password' => 'abc123456',                  //����Ա����
        'bucket'   => 'maihoho',                    //�ռ�
    ];
    $config = array_merge($config_default,$config);
    //>>ʵ�����ϴ�ͼƬ��
    $upload = new UpYunUpload($config);
    $result = $upload->uplod($imageFields);
    if ($result === false) {
        //>>�ϴ�ʧ��,��ȡ��������Ϣ
        return $upload->info;
    } else {
        //>>�ϴ��ɹ�,����upyunͼƬ·��
        return $result;
    }
}


<?php
require ('demo.class.php');
//>>�����ϴ���һЩ����;
$config = [
    'domain' => 'maihoho.b0.upaiyun.com',  //����http://
    'root' => '/img',  //��/��:/ipc  �ļ��ϴ�Ŀ¼
    'username' => 'cheqin',//�����Ʋ���Ա
    'password'  => 'abc123456',  //����
    'bucket' =>   'maihoho', //�ռ�����
];
//>>�����ͼƬ����������Ķ���ͼƬ,Ҳ������һ��ͼƬ��·��string ;
//$imageFields = [
//    'D:/server/wamp/www/day_one/image/01.jpg',
//    'D:/server/wamp/www/day_one/image/01.jpg',
//];
$imageFields = 'D:/server/wamp/www/day_one/image/01.jpg';
//>>ʵ�����ϴ�ͼƬ��  �������
$upload = new demo($config);
$result = $upload->uplod($imageFields);
if($result === false){
    //>>�ϴ�ʧ��
    var_dump($upload->info);
}else{
    //>>�ϴ��ɹ�  ����ͼƬ·��
    var_dump($result);
}




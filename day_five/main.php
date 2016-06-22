<?php
// 什么是CURL
/**
 * 是PHP中的一个扩展,用于发送请求,可以根据需要发送GET/POST等请求,通常用CURL来模拟浏览器发送请求,或者从服务器抓取资源.
 * 必须开启 php_curl扩展
 * CURL中可以封装请求头
 * curl_init() 初始化CURL
 * curl_setopt() 设置请求信息
 * curl_exec() 执行请求
 * curl_close() 释放CURL
 * apistore
 */
// 发送GET请求
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'http://www.yii.com/index.php?r=abc/abc');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
$res = curl_exec($ch);
curl_close($ch);
var_dump($res);
echo "<hr/>";
// 发送POST请求
$ch = curl_init();
$data = ['_csrf' => '5f16004bafecf0eab9c6a1478ac3361d7a91d398c0fd359f20bba57ab59a57d0a:2:{i:0;s:5:"_csrf";i:1;s:32:"tSud365fSgKxFoTGKepYJybnDOqTKN5Z";}'];
curl_setopt($ch, CURLOPT_URL, 'http://www.yii.com/abc.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'aaaaaaaa');
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$res = curl_exec($ch);
curl_close($ch);
echo $res;
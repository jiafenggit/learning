<?php
//上传文件,新建一个可以接受并显示的POST的数据文件post_output.php  :
//    print_r($_POST);
//接下来写一个php脚本执行curl请求

$url = "http://localhost/post_output.php";
$post_data = array(
    "foo"=>"bar",
    "query"=>"php",
    "action"=>"Submit"
);
$ch  = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
//设置为POST
curl_setopt($ch,CURLOPT_POST,1);
//把POST的变量加上
curl_setopt($ch,CURLOPT_POSTFIELDS,$post_data);
$output = curl_exec($ch);
curl_close($ch);
echo $output;
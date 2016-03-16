<?php
//cURL的具体实现方法
$url = "http://www.php.net/";
//1初始化
$ch = curl_init();
//2设置选项,包括URL
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);   //将curl_exec()获取的信息以文件流的形式返回
                                              //而不是输出
                                              //启用时将头文件的信息作为数据流输出
curl_setopt($ch,CURLOPT_HEADER,1);
//3执行并获取内容
$output = curl_exec($ch);
//4释放cURL句柄
curl_close($ch);
echo $output;
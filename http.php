<?php
//简单的HTTP协议的使用
	$html = file_get_contents('http://www.baidu.com/');
	print_r($http_response_header);
	$fp = fopen('http://www.baidu.com/','r');
	print_r(stream_get_meta_data($fp));
	fclose($fp);
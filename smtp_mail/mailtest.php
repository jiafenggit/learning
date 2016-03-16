<?php
/**
 * Created by PhpStorm.
 * User: ityike
 * Date: 16/3/13
 * Time: 14:38
 */

include ("smtp.php");

$host = "smtp.qq.com";
$port = 25;
$user = "username";
$pass = "password";

$from = "send@qq.com";
$to = "recv@qq.com";
$subject = "Hello World";
$body = "This is an example email for you.";

$mail = new smtp_mail($host,$port,$user,$pass);
$mail ->send_mail($from,$to,$subject,$content);

<?php
/**
 * session类的使用
 */

include 'config.php';
include 'mysql.php';
include 'session.php';
$session = new sessionSaveHandle();
ini_set('session.save_handler', "user");
session_set_save_handler(array($session,"open"),array_add($session,"close"),array($session,"destroy"),array($session,"gc"));
session_start();
$_SESSION['name'] = 'ityike';
echo $_SESSION['name'];
$_SESSION['age'] = '19';
echo $_SESSION['age'];
echo '<br/>SessionID:'.session_id();
echo '<a herf=session2.php>session2.php</a>';


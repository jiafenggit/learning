<?php
/**
 * Created by PhpStorm.
 * User: ityike
 * Date: 16/3/14
 * Time: 08:33
 */
include 'config.php';
include 'session.php';
include 'mysql.php';
$session = new SessionSaveHandle();
ini_set('session.use_trans_sid', 0);
ini_set('session.use_cookie',   1);
ini_set('session.cookie_path',    '/');
ini_set('session.save_handler', 'user');
session_module_name('user');
session_set_save_handler(array($session,"open"),array($session,"close"),array($session,"read"),array($session,"write"),array($session,"destroy"),array($session,"gc"));

session_start();
var_dump($_SESSION);
echo $_SESSION['age'];
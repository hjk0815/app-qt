<?php
/** $Id: config.php 2556 2023-11-17 06:09:40Z zhangxh $ */

session_id("0");

// 所有配置内容都可以在这个文件维护
// error_reporting(E_ERROR);
ini_set('post_max_size', '30M'); // POST  
ini_set('upload_max_filesize', '30M'); // POST  
ini_set('max_execution_time', 10); // 最大执行时间  
ini_set('default_socket_timeout', 1); // socket超时时间
ini_set('display_errors', 1); // 错误信息  
ini_set('display_startup_errors', 1); // php启动错误信息  
error_reporting(E_ALL & ~E_NOTICE); // 打印出所有的 错误信息

set_time_limit(10); // 最大执行时间  

// index
define('URL_BASE',  'http://'.$_SERVER['HTTP_HOST'].'/index.php?');
define('AJAX_BASE', 'http://'.$_SERVER['HTTP_HOST'].'/index.php?/rpc');

// 配置url路由
$route_config = array(
    '/login/' => '/main/login/',
    '/logout/' => '/main/logout/',
    );

// db
$db_config = array(
    'host' => 'localhost',
    'user' => 'root',
    'password' => '',
    'db_type' => 'mysql',
    'default_db' => 'test');



<?php

$user_config = array (
  'product_info' => 
  array (
    'version' => '2.5',
    'build' => '0625',
  ),
  'db' => 
  array (
    'host' => 'localhost',
    'port' => '3306',
    'login' => 'root',
    'password' => '',
    'database' => '',
    'prefix' => '',
  ),
  'lang' => 
  array (
    'en' => APP_PATH.'/lang/en/lang.php',
    'zh_cn' => APP_PATH.'/lang/zh_cn/lang.php',
  ),
  'launch' => 
  array (
    'router_prefilter' => 
    array (
      0 => 
      array (
        0 => 'spUrlRewrite',
        1 => 'setReWrite',
      ),
    ),
    'function_url' => 
    array (
      0 => 
      array (
        0 => 'spUrlRewrite',
        1 => 'getReWrite',
      ),
    ),
  ),
);

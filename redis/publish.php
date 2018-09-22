<?php
/**
 * 发布消息示例
 */
$config = [
    'host'=>'127.0.0.1',
    'port'=>'6379',
    'password'=>'',
];

$redis = new \Redis();
$redis->connect($config['host'], $config['port']);
$redis->auth($config['password']);
$redis->publish('channel_test1','hello world');
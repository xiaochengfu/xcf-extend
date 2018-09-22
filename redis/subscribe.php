<?php
/**
 * 订阅消息,cli下启动 php subscribe.php
 */

$config = [
    'host'=>'127.0.0.1',
    'port'=>'6379',
    'password'=>'',
];
include_once 'RedisService.php';

//$redis = new \Redis();
//$redis->connect($config['host'], $config['port']);
//$redis->auth($config['password']);

$redis = (new RedisService())->init($config['host'],$config['port'],$config['password']);
//设置永不超时
$redis->setOption(Redis::OPT_READ_TIMEOUT, -1);
//订阅的通道，可设置多个
$sub = [
    'channel_test1',
    'channel_test2',
];
$redis->subscribe($sub, function ($redis, $chan, $msg) {
    var_dump($redis);//redis对象
    var_dump('渠道:'.$chan);//通道
    var_dump('消息:'.$msg);//消息
    /**
     * 您的业务逻辑，建议通过回调方法返回到框架对象内
     * thinkphp 5.1建议
       app('app\common\logic\Callback',[
          ['server'=>1,'fid'=> 2,'data'=>3]
        ])->{'test'}();
     * yii2 建议
     * \Yii::$app->runAction('控制器','参数');
     */
});
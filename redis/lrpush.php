<?php
/**
 * Name: lrpush.php.
 * Author: hp <xcf-hp@foxmail.com>
 * Date: 2018/9/22 下午1:58
 * Description: list实现的入队出队，需要起一个计划任务，lpop或rpop入队的消息
 */
$config = [
    'host'=>'127.0.0.1',
    'port'=>'6379',
    'password'=>'',
];

include_once 'RedisService.php';

$redis = (new RedisService())->init($config['host'],$config['port'],$config['password']);

$arr = array('h','e','l','l','o','w','o','r','l','d');

/**
 * 依次从key的尾部入列,入队后的顺序
 * h e l l o w o r l d
 * 下面的例子，符合先进先出
 */
foreach($arr as $k=>$v){
    $redis->rpush("mylist1",$v);
}

$llen = $redis->lLen('mylist1');
for($i=0;$i<$llen;$i++){
    $value = $redis->lPop('mylist1');
    if($value != false){
        echo $value.PHP_EOL;
    }else{
        echo 'end';
    }
}

/**
 * 依次从key的尾部入列,入队后的顺序
 * d l r o w o l l e h
 * 下面的例子，同样符合先进先出
 */
foreach($arr as $k=>$v){
    $redis->lpush("mylist2",$v);
}
$llen = $redis->lLen('mylist2');
for($i=0;$i<$llen;$i++){
    $value = $redis->rPop('mylist2');
    if($value != false){
        echo $value.PHP_EOL;
    }else{
        echo 'end';
    }
}


<?php
/**
 * redis 类
 */

//namespace app\common\service;

class RedisService
{

    /**
     * Description:  init
     * Author: hp <xcf-hp@foxmail.com>
     * Updater:
     * @param string $host
     * @param string $port
     * @param string $password
     * @return \Redis
     */
    public function init($host='127.0.0.1',$port='6379',$password='')
    {
        $redis = new \Redis();
        $redis->connect($host, $port);
        $redis->auth($password);
        return $redis;
    }




}
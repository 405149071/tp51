<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/18
 * Time: 10:33 PM
 */

require __DIR__ . '/vendor/autoload.php';
use Workerman\Worker;
$worker = new Worker();
$worker->onWorkerStart = function(){
    $mqtt = new Workerman\Mqtt\Client('mqtt://127.0.0.1:1883');
    $mqtt->onConnect = function($mqtt) {
        $mqtt->publish('test', 'hello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtthello workerman mqtt');
    };
    $mqtt->connect();
};
Worker::runAll();

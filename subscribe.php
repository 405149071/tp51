<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/17
 * Time: 8:02 AM
 */

require __DIR__ . '/vendor/autoload.php';

use Workerman\Worker;
$worker = new Worker();
$worker->onWorkerStart = function(){
    $mqtt = new Workerman\Mqtt\Client('mqtt://127.0.0.1:1883');
    $mqtt->onConnect = function($mqtt) {
        $mqtt->subscribe('test');
    };
    $mqtt->onMessage = function($topic, $content){
        var_dump($topic, $content);
    };
    $mqtt->connect();
};
Worker::runAll();
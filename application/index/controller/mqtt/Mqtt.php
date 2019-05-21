<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/17
 * Time: 7:38 AM
 */

namespace app\index\controller\mqtt;

use Workerman;
use Workerman\Worker;

class Mqtt
{
    /**
     * 订阅者，这种方式不行，没法启动
     * 启动时候需要 php subscribe.php start
     * 可以用下边的方法去代替workman的server的启动方式
     * 如：php index.php /index/mqtt.Mqtt/start | stop | xxx
     */
    public function subscribe(){
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
    }

    /**
     * 发布方式，可以直接在任何地方使用，当然也可以在控制器直接使用
     */
    public function publish(){

        $mqtt = new Workerman\Mqtt\Client('mqtt://127.0.0.1:1883');
        $mqtt->connect();
        $mqtt->publish('hello', 'hello workerman mqtt');
// 以下为workerman的方式，不能直接用，参考前边几个方法
//        $worker = new Worker();
//        $worker->onWorkerStart = function(){
//            $mqtt = new Workerman\Mqtt\Client('mqtt://test.mosquitto.org:1883');
//            $mqtt->onConnect = function($mqtt) {
//                $mqtt->publish('hello', 'hello workerman mqtt');
//            };
//            $mqtt->connect();
//        };
//        Worker::runAll();
    }
    

    /**
     *
     * 也不能直接调用。需要下边的方法去代替workman的server的启动方式
     * 如：php index.php /index/mqtt.Mqtt/start | stop | xxx
     */

    public function index($argv=array())
    {
        $worker = new Worker();
        $worker->onWorkerStart = function(){
            $mqtt = new Workerman\Mqtt\Client('mqtt://127.0.0.1:1883');
            $mqtt->onConnect = function($mqtt) {
                $mqtt->subscribe('hello');
            };
            $mqtt->onMessage = function($topic, $content){
                var_dump($topic, $content);
            };
            $mqtt->connect();
        };
        Worker::runAll();
    }

    /**
     *
     * 直接可以启动的控制器，启动workerman的server，mqtt只是其中之一
     */
    public function start($mode='')
    {
        global $argv;
        $argv[1] = 'start';
        $argv[2] = $mode;
        $this->index($argv);
    }

    public function stop($mode='')
    {
        global $argv;
        $argv[1] = 'stop';
        $argv[2] = $mode;
        $this->index($argv);
    }

    public function restart($mode='')
    {
        global $argv;
        $argv[1] = 'restart';
        $argv[2] = $mode;
        $this->index($argv);
    }

    public function reload($mode='')
    {
        global $argv;
        $argv[1] = 'reload';
        $argv[2] = $mode;
        $this->index($argv);
    }

    public function status($mode='')
    {
        global $argv;
        $argv[1] = 'status';
        $argv[2] = $mode;
        $this->index($argv);
    }

    public function connections($mode='')
    {
        global $argv;
        $argv[1] = 'connections';
        $argv[2] = $mode;
        $this->index($argv);
    }


}
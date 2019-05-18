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
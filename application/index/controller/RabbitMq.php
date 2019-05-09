<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/5
 * Time: 1:56 PM
 */

namespace app\index\controller;

//require_once __DIR__ . '/vendor/autoload.php';
use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;


class RabbitMq
{

    public function test(){
        echo "rabbitmq";
    }

    public function hello(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();


        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', 'hello');
        echo " [x] Sent 'Hello World!'\n";

        $channel->close();
        $connection->close();
    }

    public function helloReceive()
    {
        set_time_limit(0);
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();
        $channel->queue_declare('hello', false, false,false,false);

        //两种方式1
//        $receiver = new self();
//        $channel->basic_consume('hello', '', false, true, false, false, [$receiver, 'callFunc']);

        //两种方式2
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
        };
        $channel->basic_consume('hello', '', false, true, false, false , $callback);


        while(true) {
            $channel->wait();
        }
        $channel->close();
        $connection->close();

    }

    public function callFunc($msg) {
        $content = json_decode($msg->body,true);
        var_dump($content);
        //把用户信息插入数据库
//        db('user_info')->insert([
//            'ui_username'=>$content['name'],
//            'ui_phone'=>$content['phone'],
//        ]);


    }

}
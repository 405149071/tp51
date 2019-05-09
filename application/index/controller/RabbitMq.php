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

//rbmp example
    public function test1()
    {
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();
        $channel->queue_declare('hello_111', false, true);

        $sendMsg = [
            'name'=>'kevin'.rand(1,100),
            'phone'=>'171921743'.rand(1,100),
        ];

        $msg = new AMQPMessage(json_encode($sendMsg));
        $channel->basic_publish($msg, '', 'hello_111');
        echo " [x] Sent 'Hello Kevin!'\n";
        $channel->close();
        $connection->close();
    }

    public function test(){
        echo "rabbitmq";
    }

    public function simpleSend(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();


        $channel->queue_declare('hello', false, false, false, false);
        $msg = new AMQPMessage('Hello World!');
        $channel->basic_publish($msg, '', 'hello');
        echo " [x] Sent 'Hello World!'\n";

        $channel->close();
        $connection->close();
    }

    public function simpleRecv(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();

        $channel->queue_declare('hello', false, false, false, false);

        echo " [*] Waiting for messages. To exit press CTRL+C\n";
    }

}
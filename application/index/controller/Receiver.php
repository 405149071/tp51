<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/7
 * Time: 4:31 PM
 */

namespace app\index\controller;

use PhpAmqpLib\Connection\AMQPStreamConnection;

class Receiver
{
    public function receive()
    {
        set_time_limit(0);
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();
        $channel->queue_declare('hello_111', false, true);

        $receiver = new self();
        $channel->basic_consume('hello_111', '', false, true, false, false, [$receiver, 'callFunc']);

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
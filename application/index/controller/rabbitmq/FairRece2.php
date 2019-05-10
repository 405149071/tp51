<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/10
 * Time: 2:07 PM
 */

namespace app\index\controller\rabbitmq;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;

class FairRece2
{
    public function rece()
    {
        set_time_limit(0);
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();
        $channel->queue_declare('fair', false, false,false,false);

        //两种方式1
//        $receiver = new self();
//        $channel->basic_consume('hello', '', false, true, false, false, [$receiver, 'callFunc']);

        //两种方式2
        $callback = function ($msg) {
            echo ' [x] Received ', $msg->body, "\n";
            sleep(2);
            echo "done.";

            $msg->delivery_info['channel']->basic_ack($msg->delivery_info['delivery_tag']);
        };

        $channel->basic_qos(null, 1, null);
        $channel->basic_consume('fair', '', false, false, false, false , $callback);


        while(true) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

    }
}
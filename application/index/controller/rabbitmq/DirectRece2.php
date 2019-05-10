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

class DirectRece2
{
    public function rece()
    {
        set_time_limit(0);
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();

        $channel->exchange_declare('direct_logs', 'direct', false, false, false);

        list($queue_name, ,) = $channel->queue_declare("", false, false, true, false);
        // 只接受error级别的日志
        $channel->queue_bind($queue_name, 'direct_logs', "error");

        echo " [*] Waiting for logs. To exit press CTRL+C\n";

        $callback = function ($msg) {
            echo ' [x] ', $msg->delivery_info['routing_key'], ':', $msg->body, "\n";

        };

        $channel->basic_consume($queue_name, '', false, true, false, false, $callback);
        while(true) {
            $channel->wait();
        }

        $channel->close();
        $connection->close();

    }
}
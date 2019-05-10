<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/10
 * Time: 2:05 PM
 */


namespace app\index\controller\rabbitmq;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use PhpAmqpLib\Message\AMQPMessage;
// 消息持久化
class SimpleSend2
{
    public function send(){
        $connection = new AMQPStreamConnection('localhost', 5672, 'wuzz', '123456','my_vhost');
        $channel = $connection->channel();


        $channel->queue_declare('hello', false, true, false, false);


        for($i=0;$i<50;$i++){
            $msg = new AMQPMessage('Hello World!'.$i,array('delivery_mode' => AMQPMessage::DELIVERY_MODE_PERSISTENT));
            $channel->basic_publish($msg, '', 'hello');
        }

        echo " [x] Sent 'Hello World!'\n";

        $channel->close();
        $connection->close();
    }
}
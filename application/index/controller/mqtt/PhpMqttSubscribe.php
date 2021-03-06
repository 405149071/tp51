<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/21
 * Time: 11:19 AM
 */

namespace app\index\controller\mqtt;

use Bluerhinos\phpMQTT;

class PhpMqttSubscribe
{
    public function subscribe(){
        $server = "127.0.0.1";     // change if necessary
        $port = 1883;                     // change if necessary
        $username = "";                   // set your username
        $password = "";                   // set your password
        $client_id = "phpMQTT-subscriber"; // make sure this is unique for connecting to sever - you could use uniqid()
        $mqtt = new phpMQTT($server, $port, $client_id);
        if(!$mqtt->connect(true, NULL, $username, $password)) {
            exit(1);
        }

        $procmsg = function ($topic, $msg){
            echo "Msg Recieved: " . date("r") . "\n";
            echo "Topic: {$topic}\n\n";
            echo "\t$msg\n\n";
        };

        $topics['bluerhinos/phpMQTT/examples/publishtest'] = array("qos" => 0, "function" => $procmsg);
        $mqtt->subscribe($topics, 0);

        while($mqtt->proc()){

        }
        $mqtt->close();


    }

}
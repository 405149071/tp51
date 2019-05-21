<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/21
 * Time: 11:08 AM
 */

namespace app\index\controller\mqtt;

use Bluerhinos\phpMQTT;

class PhpMqttPub{

    public function publish(){
        $server = "127.0.0.1";     // change if necessary
        $port = 1883;                     // change if necessary
        $username = "";                   // set your username
        $password = "";                   // set your password
        $client_id = "phpMQTT-publisher"; // make sure this is unique for connecting to sever - you could use uniqid()
        $mqtt = new phpMQTT($server, $port, $client_id);
        if ($mqtt->connect(true, NULL, $username, $password)) {
            $mqtt->publish("bluerhinos/phpMQTT/examples/publishtest", "Hello World! at " . date("r"), 0);
            $mqtt->close();
            echo "send ok";
        } else {
            echo "Time out!\n";
        }
    }
}
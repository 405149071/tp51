<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/21
 * Time: 8:51 PM
 */

namespace app\index\controller\mqtt;


class MosquittoPub
{
    public function publish(){

        $client = new \Mosquitto\Client();
        //$client->setCredentials('test','123456');
        $client->connect("127.0.0.1", 1883, 5);

        for($i = 0;$i<=10;$i++) {
            $client->loop();
            $mid = $client->publish('hello', "Hello from PHP at " . date('Y-m-d H:i:s'), 1, 0);
            echo "Sent message ID: {$mid}\n";
            $client->loop();

            sleep(2);
        }
    }

}
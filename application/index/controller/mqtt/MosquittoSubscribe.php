<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/21
 * Time: 8:52 PM
 */

namespace app\index\controller\mqtt;


class MosquittoSubscribe
{
    public function subscribe(){
        $c = new \Mosquitto\Client;
        //$c->setCredentials('test','123123');
        $c->connect('127.0.0.1', 1883, 50);
        $c->subscribe('ss', 1);
        $c->onMessage(function($m) {
            var_dump($m);
        });
        $c->loopForever();
    }
}
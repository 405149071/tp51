<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/4/15
 * Time: 12:32 PM
 */


namespace app\index\controller;

use app\index\logic\user\AUser;
use app\index\logic\user\obj\Person;
use app\index\logic\user\User;
use think\Controller;

class Test extends Controller
{
    public function testlayer(){
        $user = new AUser();
        dump($user->testA());
        dump(Person::testoo());
    }

    public function testShangpin(){

        $va = ["1"=>["白色","红色"],
            "3"=>["3w","5w"],
            "5"=>["zigbee","wifi"]];

        $vb = [["1_白色","3_3w","5_zigbee","100"],
            ["1_白色","3_3w","5_wifi","50"],
            ["1_白色","3_5w","5_zigbee","10"],
            ["1_白色","3_5w","5_wifi","100"],
            ["1_红色","3_3w","5_zigbee","10"],
            ["1_红色","3_3w","5_wifi","10"],
            ["1_红色","3_5w","5_zigbee","10"],
            ["1_红色","3_5w","5_wifi","10"],
        ];

        $strall = json_encode($vb);

        foreach ($va as $key => $value) {
            foreach ($value as $k=> $v){
                $kkk = json_encode($key . "_". $v);
                $str_rep = rand(1000,9999);
                $strall = str_replace($kkk,$str_rep,$strall);
            }
        }
        var_dump($strall);
    }


}
<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/4/15
 * Time: 12:32 PM
 */


namespace app\index\controller;

use app\index\logic\Lunar;
use app\index\logic\user\AUser;
use app\index\logic\user\obj\Person;
use app\index\logic\user\User;
use think\Controller;
use think\Db;

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

        // item_spec 数据按do判断增还是改
        $va = ["1_白色"=>["id"=>"","name"=>"白色","do"=>"add"],
                "1_红色"=>["id"=>"","name"=>"红色","do"=>"add"],
                "3_3w"=>["id"=>"","name"=>"3w","do"=>"add"],
                "3_5w"=>["id"=>"","name"=>"5w","do"=>"add"],
                "5_zigbee"=>["id"=>"","name"=>"zigbee","do"=>"add"],
                "5_wifi"=>["id"=>"","name"=>"wifi","do"=>"add"]
            ];

//  下边数据全删全增
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

    /***
     * 追加日历数据
     */
    public function testLunar1()
    {
        //节气数据有问题，2020，2017。。。一部分数据错位，比如清明，python提供的那个倒是对的
        set_time_limit(0);
        $start_time = '1970-01-01';
        $end_time = '2099-12-31';
        //获取时间差
        $diff= strtotime($end_time)-strtotime($start_time);
        $num = $diff/(24*60*60)+1;

        for ($i=0; $i < $num; $i++) {
            $arr = [];

            $totime = strtotime("$start_time + $i days");//重点，指定日期加减多少天
            $arr['day'] = date("Y-m-d",$totime);
            $arr['yyyy'] = date("Y",$totime);
            $arr['mm'] = date("m",$totime);
            $arr['dd'] = date("d",$totime);

            $lunar = new Lunar();
            $data = $lunar->convertSolarToLunar($arr['yyyy'], $arr['mm'], $arr['dd']);
            //var_dump($data);


            $arr['ww'] = date("w", strtotime($arr['day']));
            $arr['mm_lunar'] = $data[1];
            $arr['dd_lunar'] = $data[2];
            $arr['animals'] = $data[6];
            $arr['era'] = $data[3];
            $arr['mm_leaf'] = $data[7];
            $arr['solar_terms'] = $data[8];
            $arr['festival'] = $data[9];
            DB::table("dt_calendar")->insert($arr);

        }
        echo 'OK';
    }

    public function readFile(){
set_time_limit(0);

    for($y = 1970 ; $y<2100 ; $y++){
        $json_string = file_get_contents('/Users/wuzz/wuzztest/py/json/'.$y.'.json');
        $json_string = str_replace(" 00:00:00","",$json_string);
        //var_dump($json_string);
        // 用参数true把JSON字符串强制转成PHP数组
        $data = json_decode(json_decode($json_string,true),true);
        //var_dump($data);
        foreach ($data as $v) {
            //var_dump($v);
            $row = DB::table("dt_calendar")->where("day","=",$v['time'])->find();
            if($row){
                DB::table("dt_calendar")
                    ->where("day","=",$v['time'])
                    ->data(['solar_terms'=>$v['name']])
                    ->update();
            }
        }


    }


    }


}
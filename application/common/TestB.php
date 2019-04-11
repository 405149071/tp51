<?php
/**
 * Created by PhpStorm.
 * User: wuzz
 * Date: 2018/12/11
 * Time: 2:53 PM
 */

namespace app\common;


use app\common\iface\InterfacePMS;
use app\common\iface\Iot;

class TestB implements InterfacePMS
{
    protected  $pms = null;

    function __construct(InterfacePMS $pms,Iot $iot){
        $this->pms = $pms;
    }

    public function doins(){

        exit;
        //var_dump($this->pms);
        // 业务1


        //实际业务
        //$a = self::say();
        //echo $this->pms->order();
        echo $this->order();

        // 业务3
        //return $a;
    }

    public function say(){
        $this->pms->say();
    }

    public function order(){
        //afoajfoaf

        return $this->pms->order();

        //afafafdf
        //dfdfaf
    }



}
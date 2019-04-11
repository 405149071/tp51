<?php
/**
 * Created by PhpStorm.
 * User: wuzz
 * Date: 2018/12/11
 * Time: 2:48 PM
 */

namespace app\common\iface;

use think\model;

class DuotelPMS implements InterfacePMS
{

    public function say(){
        return "okokok";
    }

    public function order()
    {
        // TODO: Implement order() method.
        return "duo order";
    }

}
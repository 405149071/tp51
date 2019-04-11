<?php
/**
 * Created by PhpStorm.
 * User: wuzz
 * Date: 2018/11/28
 * Time: 6:15 PM
 */

namespace app\facade;
use think\Facade;


class TestFacade extends Facade
{

    protected static function getFacadeClass()
    {
        return 'app\common\Test';
    }

}
<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/7
 * Time: 12:31 PM
 */

namespace app\index\controller;

use app\common\tool\RabbitMQTool;
use think\Controller;

class TestMq extends Controller {

    public function test() {
        RabbitMQTool::instance('test')->wMq(['name'=>'123']);
    }


}
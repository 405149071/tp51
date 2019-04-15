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
}
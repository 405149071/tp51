<?php
/**
 * Created by PhpStorm.
 * User: wuzz
 * Date: 2018/11/26
 * Time: 4:37 PM
 */

//trait 相当于把代码复制到类里。实现代码复用
//trait 本身不能实例化，只能在其他类里use使用
//同名trait， 父类-》trait-》子类 ， 多个trait同名方法调用会报错，需要指定别名
//trait1
trait  Demo1{
    public function hello1(){
        return __METHOD__;
    }
}
// trait2
trait  Demo2{
    public function hello2(){
        return __METHOD__;
    }
}

class Test{

    public function hello(){
        return __METHOD__;
    }
}

// demo实例
class Demo extends Test {

    use Demo1,Demo2;

    public function hello(){
        return __METHOD__;
    }

    public function test1(){
        return $this->hello1();
    }

}

// 代码
$demo = new Demo();
//echo($demo->hello());
echo($demo->hello1());

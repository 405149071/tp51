<?php
/**
 * Created by PhpStorm.
 * User: wuzz
 * Date: 2018/11/26
 * Time: 5:20 PM
 */


//单例模式
class Sigton{

    //属性
    public $sigName;
    //实例
    protected static $instance = null ;
    //禁用构造器
    private function __construct($signame)
    {
        $this->sigName = $signame;
    }
    //公布实例方法
    public function getInstance($signame = 'php中文网'){
        //单实例
        if(!self::$instance instanceof self){
            self::$instance = new self($signame);
        }
        return self::$instance;
    }

}

// 工厂模式
class Factory{
    //创建指定类的实例
    public static function create(){
        return Sigton::getInstance("php.cn");
    }

}

//容器模式（注册数模式）

class Register{

    // 数组， 对象池
    protected static $objs=[];
    // set
    public static function set($alias,$obj){
        self::$objs[$alias] = $obj;
    }
    //get
    public static function get($alias){
        return self::$objs[$alias];
    }
    //_unset 销毁
    public static function _unset($alias){
        unset(self::$objs[$alias]);
    }

}


//运行代码 //上树
Register::set('sit',Factory::create());
//
$obj = Register::get(sit);
var_dump($obj);
echo $obj->sigName;
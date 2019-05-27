<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/5/27
 * Time: 5:59 PM
 */

namespace app\index\controller\redis;



use think\cache\driver\Redis;

class Index
{

    private $redis = null;

    public function __construct()
    {
        $redis = new \Redis();
        $redis->connect('127.0.0.1', 6379);
        $this->redis = $redis;
    }


    public function testRedis(){
        echo "Connection to server sucessfully";
        //查看服务是否运行
        echo "Server is running: " . $this->redis->ping();
    }

    public function rstr(){
        //设置 redis 字符串数据
        $this->redis->set("tutorial-name", "Redis tutorial");
        // 获取存储的数据并输出
        // 获取存储的数据并输出
        echo "Stored string in redis:: " . $this->redis->get("tutorial-name");

    }

    public function rlist(){
        //存储数据到列表中
        $this->redis->lpush("tutorial-list", "Redis");
        $this->redis->lpush("tutorial-list", "Mongodb");
        $this->redis->lpush("tutorial-list", "Mysql");
        // 获取存储的数据并输出
        $arList = $this->redis->lrange("tutorial-list", 0 ,5);
        echo "Stored string in redis";
        print_r($arList);
    }

    public function rkeys(){
        $arList = $this->redis->keys("*");
        echo "Stored keys in redis:: ";
        print_r($arList);
    }

    public function rdelete(){
        $this->redis->set('test',"1111111111111");
        echo $this->redis->get('test');   //结果：1111111111111
        $this->redis->delete('test');
        var_dump($this->redis->get('test'));  //结果：bool(false)
    }

    // 如果在数据库中不存在该键，设置关键值参数
    public function rsetnx(){
        $this->redis->set('test',"1111111111111");
        $this->redis->setnx('test',"22222222");
        echo $this->redis->get('test');  //结果：1111111111111
        $this->redis->delete('test');
        $this->redis->setnx('test',"22222222");
        echo $this->redis->get('test');  //结果：22222222
    }

    // 其他
    // exists
    // 描述：验证指定的键是否存在
    // incr
    // 描述：数字递增存储键值键.
    // decr
    //描述：数字递减存储键值。
    // getMultiple
    //描述：取得所有指定键的值。如果一个或多个键不存在，该数组中该键的值为假
    // lpush
    //描述：由列表头部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE。
    // rpush
    //描述：由列表尾部添加字符串值。如果不存在该键则创建该列表。如果该键存在，而且不是一个列表，返回FALSE。
    // lpop
    //描述：返回和移除列表的第一个元素
    // lsize,llen
    //描述：返回的列表的长度。如果列表不存在或为空，该命令返回0。如果该键不是列表，该命令返回FALSE。
    // lget
    //描述：返回指定键存储在列表中指定的元素。 0第一个元素，1第二个… -1最后一个元素，-2的倒数第二…错误的索引或键不指向列表则返回
    // lset
    //描述：为列表指定的索引赋新的值,若不存在该索引返回false.
    // lgetrange
    //描述：
    //返回在该区域中的指定键列表中开始到结束存储的指定元素，lGetRange(key, start, end)。0第一个元素，1第二个元素… -1最后一个元素，-2的倒数第二…
    // lremove
    //描述：从列表中从头部开始移除count个匹配的值。如果count为零，所有匹配的元素都被删除。如果count是负数，内容从尾部开始删除。
    // sadd
    //描述：为一个Key添加一个值。如果这个值已经在这个Key中，则返回FALSE。

    public function rsadd(){
        $this->redis->delete('test');
        var_dump($this->redis->sadd('test','111'));   //结果：bool(true)
        var_dump($this->redis->sadd('test','333'));   //结果：bool(true)
        print_r($this->redis->sort('test')); //结果：Array ( [0] => 111 [1] => 333 )
    }

    // sremove
    //描述：删除Key中指定的value值
    // smove
    //描述：将Key1中的value移动到Key2中
    // scontains
    //描述：检查集合中是否存在指定的值。
    // ssize
    //描述：返回集合中存储值的数量
    // spop
    //描述：随机移除并返回key中的一个值
    // sinter
    //描述：返回一个所有指定键的交集。如果只指定一个键，那么这个命令生成这个集合的成员。如果不存在某个键，则返回FALSE。
    // sinterstore
    //描述：执行sInter命令并把结果储存到新建的变量中。
    // sunion
    //描述：返回一个所有指定键的并集
    // sunionstore
    //描述：执行sunion命令并把结果储存到新建的变量中。
    // sdiff
    //描述：返回第一个集合中存在并在其他所有集合中不存在的结果
    // sdiffstore
    //描述：执行sdiff命令并把结果储存到新建的变量中。
    // smembers, sgetmembers
    //描述：
    //返回集合的内容





}
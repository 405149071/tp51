<?php
namespace app\index\controller;

use app\common\DuotelPMS;
use app\common\TestB;
use app\index\model\Student;
use think\Controller;

$GLOBALS['oauth_weixin'] = array(
    'appid'			=>	'wx1af1087d38dbef58',
    'appkey'		=>	'acef1288f8fa51a0df2df42a112f6c35',
    'callbackUrl'	=>	'http://test.iduotel.com/',
);
$GLOBALS['oauth_weibo'] = array(
    'appid'			=>	'2132894336',
    'appkey'		=>	'0791cf9fdbb8bbb4f2622b4356690e63',
    'callbackUrl'	=>	'http://test.iduotel.com/index/index/wbcallback',
);

class Index extends Controller
{
    public function index()
    {
        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:) </h1><p> ThinkPHP V5.1<br/><span style="font-size:30px">12载初心不改（2006-2018） - 你值得信赖的PHP框架</span></p></div><script type="text/javascript" src="https://tajs.qq.com/stats?sId=64890268" charset="UTF-8"></script><script type="text/javascript" src="https://e.topthink.com/Public/static/client.js"></script><think id="eab4b9f840753f8e7"></think>';
    }

    public function hello($name = 'ThinkPHP5')
    {
        return 'hello,' . $name;
    }

    public function testdb(){
        $student = new Student();
        //$student -> name = "张三";
        //$student -> save();

        $res = $student -> where('id','=',1)->select();
        dump($res);
        dump($res instanceof Student); // find 1条记录是对象，select 是二维的，但不是对象
        dump(is_array($res)); // find 和 select 的结果都不是数组
    }



    //测试代理模式
    public function testdaili(){

        $test = new TestB(new \app\common\iface\DuotelPMS(),new \app\common\iface\Iotlampzigbee());
        return $test->doins();
    }

    //微信和微博登录
    public function weixin(){
        $wxOAuth = new \Yurun\OAuthLogin\Weixin\OAuth2($GLOBALS['oauth_weixin']['appid'], $GLOBALS['oauth_weixin']['appkey']);// 解决只能设置一个回调域名的问题，下面地址需要改成你项目中的地址，可以参考./loginAgent.php写法
// $wxOAuth->loginAgentUrl = 'http://localhost/test/Weixin/loginAgent.php';
// 所有为null的可不传，这里为了演示和加注释就写了
        $url = $wxOAuth->getAuthUrl(
            $GLOBALS['oauth_weixin']['callbackUrl'],	// 回调地址，登录成功后返回该地址，为null则取来源页面
            null,										// state 为空自动生成
            null										// scope 只要登录默认为空即可
        );
        var_dump($url);
    }

    //微信回调测试
    public function wxcallback(){
        log4()->debug("进入微信回调1");
        log4()->debug($this->request->param());
    }

    public  function weibo(){
        $weiboOAuth = new \Yurun\OAuthLogin\Weibo\OAuth2($GLOBALS['oauth_weibo']['appid'], $GLOBALS['oauth_weibo']['appkey'], $GLOBALS['oauth_weibo']['callbackUrl']);
// 解决只能设置一个回调域名的问题，下面地址需要改成你项目中的地址，可以参考./loginAgent.php写法
// $weiboOAuth->loginAgentUrl = 'http://test.com/test/Weibo/loginAgent.php';
// 可选属性
        /*
        // 授权页面的终端类型，取值见微博文档。http://open.weibo.com/wiki/Oauth2/authorize
        $qqOAuth->display = null;
        // 是否强制用户重新登录，true：是，false：否。默认false。
        $qqOAuth->forcelogin = false;
        // 授权页语言，缺省为中文简体版，en为英文版。
        $qqOAuth->language = null;
        */
// 所有为null的可不传，这里为了演示和加注释就写了
        $url = $weiboOAuth->getAuthUrl(
            null,	// 回调地址，登录成功后返回该地址
            null,	// state 为空自动生成
            null	// scope 只要登录默认为空即可
        );
        $_SESSION['YURUN_WEIBO_STATE'] = $weiboOAuth->state;
        header('location:' . $url);
    }

    public function wbcallback(){
        log4()->debug("进入微博回调1");
        log4()->debug($this->request->param());
    }

    public function info(){
        phpinfo();
    }

}

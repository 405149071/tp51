<?php
/**
 *
 * Created by tp51.
 * User: wuzz
 * Date: 2019/4/15
 * Time: 2:03 PM
 */
namespace app\index\controller;

use think\Controller;
use tinymeng\OAuth2\OAuth;
use tinymeng\tools\Tool;

class Login extends Controller
{
    private $configFile = "thirdlogin";
    //private $callbackDomain = "http://test.iduotel.com";

    protected $config;

    /**
     * Description:  登录
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param $name
     * @return mixed
     */
    public function index($name)
    {

        if (empty(input('get.'))) {
            /** 登录 */
            $result = $this->login($name);
            $this->redirect($result);
        }
        /** 登录回调 */
        $this->callback($name);
        return $this->fetch('index');
    }

    /**
     * Description:  获取配置文件
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param $name
     */
    public function getConfig($name){
        //可以设置代理服务器，一般用于调试国外平台
        //$this->config['proxy'] = 'http://127.0.0.1:1080';

        $this->config = config($this->configFile .".".$name);
        if($name == 'weixin'){
            if(!Tool::isMobile()){
                $this->config = $this->config['pc'];//微信pc扫码登录
            }elseif(Tool::isWeiXin()){
                $this->config = $this->config['mobile'];//微信浏览器中打开
            }else{
                echo '请使用微信打开!';exit();//手机浏览器打开
            }
            $this->config['state'] = 'LOGIN';
        }
    }

    /**
     * Description:  登录链接分配，执行跳转操作
     * Author: JiaMeng <666@majiameng.com>
     * Updater:
     */
    public function login($name){
        /** 获取配置 */
        $this->getConfig($name);

        /**
         * 如果需要微信代理登录，则需要：
         * 1.将wx_proxy.php放置在微信公众号设定的回调域名某个地址，如 http://www.abc.com/proxy/wx_proxy.php
         * 2.config中加入配置参数proxy_url，地址为 http://www.abc.com/proxy/wx_proxy.php
         * 然后获取跳转地址方法是getProxyURL，如下所示
         */
        //$this->config['proxy_url'] = 'http://www.abc.com/proxy/wx_proxy.php';

        $oauth = OAuth::$name($this->config);
        if(Tool::isMobile() || Tool::isWeiXin()){
            /**
             * 对于微博，如果登录界面要适用于手机，则需要设定->setDisplay('mobile')
             * 对于微信，如果是公众号登录，则需要设定->setDisplay('mobile')，否则是WEB网站扫码登录
             * 其他登录渠道的这个设置没有任何影响，为了统一，可以都写上
             */
            $oauth->setDisplay('mobile');
        }
        return $oauth->getRedirectUrl();
    }

    /**
     * Description:  登录回调
     * @author: JiaMeng <666@majiameng.com>
     * Updater:
     * @param $name
     * @return bool
     */
    public function callback($name)
    {
        /** 获取配置 */
        $this->getConfig($name);

        /** 获取第三方用户信息 */
        $userInfo = OAuth::$name($this->config)->userInfo();
        /**
         * 如果是App登录
         * $userInfo = OAuth::$name($this->config)->setIsApp()->userInfo();
         */

        //获取登录类型
        $userInfo['type'] = \tinymeng\OAuth2\Helper\ConstCode::getType($userInfo['channel']);

        var_dump($userInfo);die;

    }
}

<?php
/**
 * 三方授权登陆的配置文件
 */

return [
    'weixin'=>[
        'pc'=>[
            'app_id' => 'wx1af1087d38dbef58',
            'app_secret' => 'acef1288f8fa51a0df2df42a112f6c35',
            'scope'      => 'snsapi_login',//扫码登录
            'callback' => 'http://test.iduotel.com/index/login/index/name/weixin',
        ],
        'mobile'=>[
            'app_id' => '1',
            'app_secret' => '',
            'scope'      => 'snsapi_userinfo',//静默授权=>snsapi_base;获取用户信息=>snsapi_userinfo
        ],
    ],
    'sina' => [
        'app_id'     => '2132894336',
        'app_secret' => '0791cf9fdbb8bbb4f2622b4356690e63',
        'scope'      => 'all',
        'callback' => 'http://test.iduotel.com/index/login/index/name/sina',
    ],
    'qq'=>[
        'app_id'        => '1014*****',
        'app_secret'    => '8a2b322610d7a0d****',
        'scope'         => 'get_user_info',
        'is_unionid' => true //已申请unioid打通
    ]
];
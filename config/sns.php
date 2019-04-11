
<?php

return [
    'weixin' => [
        'app_id'     => 'wx1af1087d38dbef58',
        'app_secret' => 'acef1288f8fa51a0df2df42a112f6c35',
        'scope'      => 'snsapi_userinfo',//如果需要静默授权，这里改成snsapi_base，扫码登录系统会自动改为snsapi_login
    ],
    'weibo' => [
        'app_id'     => '2132894336',
        'app_secret' => '0791cf9fdbb8bbb4f2622b4356690e63',
        'scope'      => 'all',
    ]
];
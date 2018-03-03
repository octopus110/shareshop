<?php

return [
    /*
     * Debug 模式，bool 值：true/false
     *
     * 当值为 false 时，所有的日志都不会记录
     */
    'debug' => false,

    /*
     * 使用 Laravel 的缓存系统
     */
    'use_laravel_cache' => true,

    /*
     * 账号基本信息，请从微信公众平台/开放平台获取
     */
    'app_id' => env('WECHAT_APPID', ''),
    'secret' => env('WECHAT_SECRET', ''),
    'token' => env('WECHAT_TOKEN', ''),
    'aes_key' => env('WECHAT_AES_KEY', ''),                    // EncodingAESKey

    /**
     * 开放平台第三方平台配置信息
     */
    // 'open_platform' => [
    //     'app_id'  => env('WECHAT_OPEN_PLATFORM_APPID', ''),
    //     'secret'  => env('WECHAT_OPEN_PLATFORM_SECRET', ''),
    //     'token'   => env('WECHAT_OPEN_PLATFORM_TOKEN', ''),
    //     'aes_key' => env('WECHAT_OPEN_PLATFORM_AES_KEY', ''),
    // ],

    /**
     * 小程序配置信息
     */
    // 'mini_program' => [
    //     'app_id'  => env('WECHAT_MINI_PROGRAM_APPID', ''),
    //     'secret'  => env('WECHAT_MINI_PROGRAM_SECRET', ''),
    //     'token'   => env('WECHAT_MINI_PROGRAM_TOKEN', ''),
    //     'aes_key' => env('WECHAT_MINI_PROGRAM_AES_KEY', ''),
    // ],

    /**
     * 路由配置
     */
    'route' => [
        'enabled' => false,         // 是否开启路由
        'attributes' => [           // 路由 group 参数
            'prefix' => null,
            'middleware' => null,
            'as' => 'easywechat::',
        ],
        'open_platform_serve_url' => 'open-platform-serve', // 开放平台服务URL
    ],

    /*
     * 日志配置
     *
     * level: 日志级别，可选为：
     *                 debug/info/notice/warning/error/critical/alert/emergency
     * file：日志文件位置(绝对路径!!!)，要求可写权限
     */
    'log' => [
        'level' => env('WECHAT_LOG_LEVEL', 'debug'),
        'file' => env('WECHAT_LOG_FILE', storage_path('logs/wechat.log')),
    ],

    /*
     * OAuth 配置
     *
     * only_wechat_browser: 只在微信浏览器跳转
     * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
     * callback：OAuth授权完成后的回调页地址(如果使用中间件，则随便填写。。。)
     */
    'oauth' => [
        'only_wechat_browser' => false,
        'scopes' => array_map('trim', explode(',', env('WECHAT_OAUTH_SCOPES', 'snsapi_userinfo'))),
        'callback' => env('WECHAT_OAUTH_CALLBACK', '/oauth_callback'),
    ],

    /*
     * 微信支付
     */
    'payment' => [
        'merchant_id' => env('MERCHANT_ID', ''),
        'key' => env('WEICHAT_PAY', ''),
        'cert_path' => '/data/shareshop/public/cert/apiclient_cert.pem',
        'key_path' => '/data/shareshop/public/cert/apiclient_key.pem',
    ],

    'enable_mock' => env('WECHAT_ENABLE_MOCK', false),
];

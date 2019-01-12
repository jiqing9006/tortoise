<?php
// 用户的一些配置
return array(
    // 微信相关
    'APPID'                     => 'wx93524749f8f5ae5c',
    'APP_SECRET'                => '0511cf134916252fb8cce5f764c65b4a',
    'MCHID'                     => '1522888051',
    'WEIXIN_PAY_KEY'            => '0010SqBoyTanTtklb0010XiaoTanShXa',
    'NOTIFY_URL'                => 'https://a.squmo.com/goodteach/Pay/order_notice',

    // 七牛相关
    'QINIU' => [
        'ACCESS_KEY' => 'cEC-5qrVjUjZ_1jlMhAUnxs1u5KQ239uEM5DwyhD',   // 七牛的
        'SECRET_KEY' => 'bznioH8ezy4GC-s2eYeMesPATNQNhCV4PZ0aObL8',
        'BUCKET'     => 'xiaotanshengxian',
    ],

    // Redis
    'REDIS_HOST'                =>  '127.0.0.1',
    'REDIS_PORT'                =>  6379,

    // URL
    'SF_HOST'                   => 'http://jiqing.myadmin.com/',
    'CDN_HOST'                  => 'https://cdn.caomall.net/',
    'IMG_HOST'                  => 'http://jiqing.myadmin.com/',

    // Page
    'PAGE_NORMAL_COUNT'			=>	20,
    'PAGE_NORMAL'				=>	16,
);
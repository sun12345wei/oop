<?php
return [
    'mode' => 'dev',        //  dev （开发模式）   pro（上线模式)
    'redis' => [
        'scheme' => 'tcp',
        'host' => '127.0.0.1',
        'port' => 6379,
    ],
    'db' => [
        'host' => '127.0.0.1',
        'dbname' => 'blog',
        'user' => 'root',
        'pass' => '',
        'charset' => 'utf8',
    ],
    'email' => [
        'mode' => '',    // 值：debug  和 production
        'port' => 25,
        'host' => 'smtp.126.com',
        'name' => 'czxy_sw@126.com',
        'pass' => 'sun021028wei',
        'from_email' => 'czxy_sw@126.com',
        'from_name' => '全栈1班',
    ]
];
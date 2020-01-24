<?php


$config = [
    'id' => 'shop-console-production',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        '@tests' => '@app/tests',
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=pscrimeacm_andru',
            'username' => 'pscrimeacm_andru',
            'password' => 'Qwerty123',
            'charset' => 'utf8',
        ],
    ],
    'modules' => [
        'gii' => [
            'class' => 'yii\gii\Module',
        ]
    ],
    'params' => [

    ]
];

return $config;
<?php

$config = [
    'id' => 'api-production',
    'basePath' => dirname(__DIR__),
    'language' => 'ru',
    'timeZone' => 'Europe/Moscow',
    'controllerNamespace' => 'app\api\controllers',
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm' => '@vendor/npm-asset',
        '@api' => dirname(__DIR__).'/api'
    ],
    'components' => [
        'request' => [
            'cookieValidationKey' => 'WUah5bHBPPWNevpbCnwJEKZAjgb2zv-1',
            'baseUrl' => ''
        ],
        'response' => [
            'format' => yii\web\Response::FORMAT_XML,
            'formatters' => [
                'xml' => [
                    'class' => 'yii\web\XmlResponseFormatter',
                    'rootTag' => 'data'
                ]
            ]
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
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
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'GET api/product'  => 'product/index'
            ],
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => ',',
            'thousandSeparator' => ' ',
            'currencyCode' => 'RU',
        ]
    ],
    'modules' => [],
    'params' => [],
];

return $config;
<?php
define('YII_ENV', trim(file_get_contents('../.env')));

define('YII_ENV_DEV', 'development');
define('YII_ENV_PROD', 'production');

define('YII_DEBUG', YII_ENV !== YII_ENV_PROD);

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../vendor/yiisoft/yii2/Yii.php';

$config = require (__DIR__ . '/../config/web-' . YII_ENV . '.php');

(new yii\web\Application($config))->run();

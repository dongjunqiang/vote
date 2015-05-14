<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-learn',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'learn\controllers',
    'bootstrap' => ['log'],
    'modules' => [],
    'language' => 'zh-cn',
    'components' => [
        'voteDb' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=vote',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
            'tablePrefix' => '',
            'enableSchemaCache' => true
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];

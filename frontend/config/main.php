<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'frontend\controllers',
    'defaultRoute' => 'content',
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => ['@frontend/views' => '@frontend/themes/default'],
                'baseUrl' => '@web/themes/default'
            ],
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
            'errorAction' => 'content/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'suffix' => '.html',
            'rules' => [
                '<page:\d+>' => 'content/index',
                '<pinyin:[\w-]+>/list_<id:\d+>_?<page:\d+>?' => 'content/list',
                '<pinyin:[\w-]+>/show_<id:\d+>' => 'content/show',
                'content/<action:\w+>/<id:\d+>/<page:\d+>' => 'content/<action>',
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
        'assetManager' => [
            'bundles' => [
                // you can override AssetBundle configs here
                'yii\web\JqueryAsset' => [
                    'sourcePath' => '@webroot/themes/default/js',
                    'js' => ['jquery.min.js']
                ],
            ],
        ],
    ],
    'params' => $params,
];

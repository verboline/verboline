<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','debug'],
    'components' => [
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
       'modules' => [
        'debug' => [
            'class' => 'yii\debug\Module',
            'allowedIPs' => ['192.168.1.*', '31.204.96.224', '95.79.97.93', '::1']
        ],
        'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['192.168.1.*', '31.204.96.224', '95.79.97.93', '::1']
        ]   
    ],
];

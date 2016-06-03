<?php

$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'negocios',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'defaultRoute' => 'site/index',
    'language' => 'pt-BR',
    'sourceLanguage' => 'en-US',    
    'components' => [   
        'request' => [
            'cookieValidationKey' => 'pZimOwEEKa95a8BMJx-r8GftAYE0iqf_',
        ],
        // 'urlManager' => [
        //     'class' => 'yii\web\UrlManager',
        //     'showScriptName' => false,
        //     'enablePrettyUrl' => true,
        //     'rules' => array(
        //             '<controller:\w+>/<id:\d+>' => '<controller>/view',
        //             '<controller:\w+>/<action:\w+>/<id:\d+>' => '<controller>/<action>',
        //             '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
        //     ),
        // ],        
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],        
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport' => true,
            'messageConfig' => [
                'from' => ['admin@website.com' => 'Admin'],
                'charset' => 'UTF-8',
            ]
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
        'db' => require(__DIR__ . '/db.php'),
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module',
            // enter optional module parameters below - only if you need to  
            // use your own export download action or custom translation 
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],    
        'redactor' => 'yii\redactor\RedactorModule',
    ],    
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;

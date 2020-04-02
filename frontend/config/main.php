<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
    //require(__DIR__ . '/giiant.php')
);

return [
    'id' => 'app-frontend',
    'name'=>'Reibach',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'de', // german'language'=>'de_DE', // german
    //'language'=>'de', // german'language'=>'de_DE', // german
        //'language'=>'nds_NDS', // plattdütsch
    'controllerNamespace' => 'frontend\controllers',
    'components' => [

            // Override the urlManager component
        'urlManager' => [
            'class' => 'codemix\localeurls\UrlManager',

            // List all supported languages here
            // Make sure, you include your app's default language.
            'languages' => ['de', 'nd', 'en'],
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
                        'enableSession' => true,
                        'authTimeout' => 600, // 10 min
                        'loginUrl' => ['site/login'],
        ],

        //'session' => [
        //'class' => 'yii\web\Session',
        //'cookieParams' => ['httponly' => true, 'lifetime' => 20],
        //'timeout' => 20, //session expire
        //'useCookies' => true,
    //],
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

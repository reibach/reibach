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
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'de_DE', // german'language'=>'de_DE', // german
    //'language'=>'de', // german'language'=>'de_DE', // german
	//'language'=>'nds_NDS', // plattdütsch
    'controllerNamespace' => 'frontend\controllers',
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => false,
			'enableSession' => true,
			'authTimeout' => 300, // 5 min
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

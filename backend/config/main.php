<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'name' => 'ICOMP',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'sourceLanguage' => 'en',
    'language' => 'pt-BR',
    'timeZone' => 'America/Manaus',


    'modules' => [
	'gii' => [
            'class' => 'yii\gii\Module',
            'allowedIPs' => ['127.0.0.1', '::1', '192.168.1.101'],
            //'password' => '123456'
        ],
       'datecontrol' =>  [
          'class' => '\kartik\datecontrol\Module',

            // format settings for displaying each date attribute (ICU format example)
            'displaySettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'dd-MM-yyyy',
                \kartik\datecontrol\Module::FORMAT_TIME => 'HH:mm a',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'dd-MM-yyyy HH:mm a',
            ],

            // format settings for saving each date attribute (PHP format example)
            'saveSettings' => [
                \kartik\datecontrol\Module::FORMAT_DATE => 'php:U', // saves as unix timestamp
                \kartik\datecontrol\Module::FORMAT_TIME => 'php:H:i',
                \kartik\datecontrol\Module::FORMAT_DATETIME => 'php:Y-m-d H:i',
            ],
        ]
    ],


    'components' => [
        'session' => [
            'name' => 'PHPBACKENDSESSID',
            'savePath' => sys_get_temp_dir(),
        ],
		    'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
			      'identityCookie' => [
                'name' => '_backendUser', // unique for backend
            ]
        ],


        'view' => [
             'theme' => [
                 'pathMap' => [
                    //'@app/views' => '@vendor/dmstr/yii2-adminlte-asset/example-views/yiisoft/yii2-app/'
                    '@app/views' => '@backend/views/adminLTE/yiisoft/yii2-app/'
                 ],
             ],
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
        'request' => [
            'enableCsrfValidation' => false
        ],
    ],
    'params' => $params,
];

<?php

$params = require __DIR__ . '/params.php';
$db     = require __DIR__ . '/db.php';

$config = [
    'id'           => 'basic',
    'language'     => 'uk-UA',
    'name'         => 'D-Shop',
    'defaultRoute' => 'store/default/index',
    'basePath'     => dirname(__DIR__),
    'bootstrap'    => ['log'],
    'aliases'      => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'components'   => [
        'cart'         => [
            'class' => \app\models\Cart::class,
        ],
        'request'      => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'ncGKb-Q5w8JjXdp9SmeQIGnyDQMcPzSb',
        ],
        'cache'        => [
            'class' => 'yii\caching\FileCache',
        ],
        'user'         => [
            'identityClass'   => 'app\models\User',
            'enableAutoLogin' => true,
            'loginUrl'        => ['admin/auth/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer'       => [
            'class'            => \yii\symfonymailer\Mailer::class,
            'viewPath'         => '@app/mail',
            // send all mails to a file by default.
            'useFileTransport' => true,
        ],
        'log'          => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'i18n'         => [
            'translations' => [
                'app*'    => [
                    'class'          => \yii\i18n\PhpMessageSource::class,
                    'basePath'       => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap'        => [
                        'app' => 'app.php',
                    ],
                ],
                'public*' => [
                    'class'          => \yii\i18n\PhpMessageSource::class,
                    'basePath'       => '@app/messages',
                    'sourceLanguage' => 'en-US',
                    'fileMap'        => [
                        'public' => 'public.php',
                    ],
                ],
            ],
        ],
        'db'           => $db,
        'fileStorage'  => [
            'class'          => \yii2tech\filestorage\local\Storage::class,
            'basePath'       => '@app/web/uploads',
            'baseUrl'        => '/uploads',
            'dirPermission'  => 0777,
            'filePermission' => 0777,
            'buckets'        => [
                'images' => [
                    'baseSubPath'        => 'images',
                    'fileSubDirTemplate' => '{^name}{^^name}',
                ],
            ],
        ],
        'urlManager'   => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [
                ''                             => '/store/default/index',
                '/checkout'                    => '/store/checkout/index',
                '/category/c<id:\d+>/<url:.+>' => '/store/category/index',
                '/product/p<id:\d+>/<url:.+>'  => '/store/product/index',
            ],
        ],
        'assetManager' => [
            //'linkAssets' => true,
        ],
    ],
    'params'       => $params,
    'modules'      => [
        'admin' => [
            'class' => \app\modules\admin\Module::class,
        ],
        'store' => [
            'class' => \app\modules\store\Module::class,
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

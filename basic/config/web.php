<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'container' => [
        'definitions' => [
            app\modules\parseKgdGovKz\interfaces\ResolveCaptchaInterface::class => app\modules\parseKgdGovKz\models\ResolveCaptcha::class,
            app\modules\parseKgdGovKz\interfaces\UidInterface::class => app\modules\parseKgdGovKz\models\UidManipulations::class,
            app\modules\parseKgdGovKz\interfaces\DataBehindCaptchaInterface::class => app\modules\parseKgdGovKz\models\DataBehindCaptcha::class,
            app\modules\parseKgdGovKz\interfaces\AntiCaptchaTaskProtocolInterface::class => function () {
                return new app\modules\parseKgdGovKz\models\CaptchaImageToText();
            },
            app\modules\parseKgdGovKz\interfaces\DbOperationsInterface::class => app\modules\parseKgdGovKz\models\DbOperations::class,
        ],
    ],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'j0zsyDpveGUsr42tIR9CiuL0jOVua4L1',
        ],
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
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
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
        'db' => $db,
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
    ],
    'modules' => [
        'parseKgdGovKz' => [
            'class' => 'app\modules\parseKgdGovKz\Module',
            'searchUrl' => 'http://kgd.gov.kz/apps/services/culs-taxarrear-search-web/rest/search',
            'getCaptchaUrl' => 'http://kgd.gov.kz/apps/services/CaptchaWeb/generate',
            'apiKey' => '',
        ],
    ],
    'defaultRoute' => 'parseKgdGovKz',
    'params' => $params,  
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '10.17.2.156'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        'allowedIPs' => ['127.0.0.1', '10.17.2.156'],
    ];
}

return $config;

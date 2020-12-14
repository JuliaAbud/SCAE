<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
	'language' => 'es',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
	/* 'modules' => [
        'api' => [
            'class' => 'app\modules\api\Api',
        ],
    ],*/
    'components' => [
	'validacion' => array(
            'class' => 'site/error',
        ),
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '432L4Rr7iMsUxWpqJCOPqdebuYoET9Gh',
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
            'useFileTransport' => false,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'encryption' => 'tls',
                'host' => 'covidcinvestav.com',
                'port' => '25',
                'username' => 'confirmacion@covidcinvestav.com',
                'password' => 'Fc2n#1z8',
            ],             
        ],
		'mail' => [
         'class' => 'yii\swiftmailer\Mailer',
         'transport' => [
             'class' => 'Swift_SmtpTransport',
             'host' => 'covidcinvestav.com',  // ej. smtp.mandrillapp.com o smtp.gmail.com
             'username' => 'confirmacion@covidcinvestav.com',
             'password' => 'Fc2n#1z8',
             'port' => '25', // El puerto 25 es un puerto común también
             'encryption' => 'tls', // Es usado también a menudo, revise la configuración del servidor
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
        'db' => $db,
        'urlManager' => [
            'enablePrettyUrl' => false,
            'showScriptName' => false,
			'enableStrictParsing' => true,
            'rules' => [
			 ['class' => 'yii\rest\UrlRule', 'controller' => 'api'],
            ],
        ],
		'request' => [
			'enableCookieValidation' => false,

			'enableCsrfValidation' => false,
            'csrfParam' => '_csrf-frontend',
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ]
        ],
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;

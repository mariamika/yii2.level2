<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log','events'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'tasks' => [
            'class' => 'frontend\modules\tasks\tasks',
        ],
        'myTask' => [
            'class' => 'frontend\modules\myTask\myTask',
        ],
        'chat' => [
            'class' => 'frontend\modules\chat\chat'
        ],
        'projects' => [
            'class' => 'frontend\modules\projects\projects',
        ],
    ],
    'components' => [
        'events' => [
            'class' => 'common\components\eventComponents\EventComponent',
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
            'cookieValidationKey' => $params['cookieValidationKey'],
        ],
        'bot' => [
            'class' => 'SonkoDmitry\Yii\TelegramBot\Component',
            'apiToken' => '659141043:AAEzKcyMFSXyVW3lg1-wd-xC_1FGuIABKgs',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity', 'httpOnly' => true, 'domain' => $params['cookieDomain']],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced',
            'cookieParams' => [
                'httpOnly' => true,
                'domain' => $params['cookieDomain'],
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
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:\w+>/<action:\w+>' => '<controller>/<action>',
            ],
        ],
    ],
    'params' => $params,
];

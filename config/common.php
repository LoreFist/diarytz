<?php

use app\modules\wallets\modules\advcash\components\client\authDTO;

$db = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . DIRECTORY_SEPARATOR . 'db.php'),
    require(__DIR__ . DIRECTORY_SEPARATOR . 'db-local.php')
);

$params = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
    require(__DIR__ . DIRECTORY_SEPARATOR . 'params-local.php')
);

return [
    'name'       => 'Diary',
    'timeZone'   => 'Asia/Novosibirsk',
    'language'   => 'ru-RU',
    'basePath'   => dirname(__DIR__),
    'bootstrap'  => [
        'log',
    ],
    'aliases'    => [
        '@bower'   => '@vendor/bower-asset',
        '@npm'     => '@vendor/npm-asset',
        '@modules' => '@app/modules',
        '@uploads' => '@app/web/uploads',
    ],
    'components' => [
        'db'              => $db,
        'log'             => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => \yii\log\FileTarget::class,
                    'levels' => ['error', 'warning'],
                ],

            ],
        ],
        'urlManager'      => [
            'enablePrettyUrl' => true,
            'showScriptName'  => false,
            'rules'           => [],
        ],
        'cache'           => [
            'class' => 'yii\caching\FileCache',
        ],
        'mailer'          => [
            'class'            => \yii\swiftmailer\Mailer::class,
            'transport'        => [
            ],
            'useFileTransport' => YII_DEBUG, // @runtime/mail/
        ],
        'authManager'     => [
            'class' => \yii\rbac\DbManager::class,
        ],
    ],
    'params'     => $params,
];

<?php

use yii\helpers\ArrayHelper;
use yii\log\FileTarget;
use yii\mail\MailerInterface;
use yii\mutex\MysqlMutex;
use yii\queue\db\Queue;
use yii\queue\LogBehavior;
use yii\rbac\DbManager;
use yii\swiftmailer\Mailer;

$db = ArrayHelper::merge(
    require(__DIR__ . DIRECTORY_SEPARATOR . 'db.php'),
    require(__DIR__ . DIRECTORY_SEPARATOR . 'db-local.php')
);

$params = ArrayHelper::merge(
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
        'queue',
    ],
    'aliases'    => [
        '@bower'   => '@vendor/bower-asset',
        '@npm'     => '@vendor/npm-asset',
        '@modules' => '@app/modules',
        '@uploads' => '@app/web/uploads',
    ],
    'container'  => [
        'definitions' => [
            MailerInterface::class => function () {
                return Yii::$app->getMailer();
            },
        ],
    ],
    'components' => [
        'db'              => $db,
        'log'             => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets'    => [
                [
                    'class'  => FileTarget::class,
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
        'mailer' => [
            'class'            => Mailer::class,
            'transport'        => [
            ],
            'useFileTransport' => YII_DEBUG, // @runtime/mail/
        ],
        'authManager'     => [
            'class' => DbManager::class,
        ],
        'queue'           => [
            'class'     => Queue::class,
            'db'        => 'db',
            'tableName' => '{{%queue}}',
            'channel'   => 'default',
            'mutex'     => MysqlMutex::class,
            'as log'    => LogBehavior::class,
        ],
    ],
    'params'     => $params,
];

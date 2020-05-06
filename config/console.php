<?php

$config = [
    'id'                  => 'basic-console',
    'basePath'            => dirname(__DIR__),
    'controllerNamespace' => 'app\commands',
    'aliases'             => [
        '@bower'   => '@vendor/bower-asset',
        '@npm'     => '@vendor/npm-asset',
        '@tests'   => '@app/tests',
        '@webroot' => dirname(dirname(__FILE__)) . '/web',
        '@runtime' => dirname(dirname(__FILE__)) . '/runtime',
    ],
    'components'          => [
        'urlManager' => [
            'baseUrl' => 'https://site.com/',
        ],

        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log'   => [
            'targets' => [
                [
                    'class'  => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],

    ],
    'controllerMap'       => [
        'fixture'           => [ // Fixture generation command line.
                                 'class' => 'yii\faker\FixtureController',
        ],
        'migrate'           => [
            'class'               => 'yii\console\controllers\MigrateController',
            'migrationPath'       => [
                '@app/modules/user/migrations',
            ],
            'migrationNamespaces' => [
                'yii\queue\db\migrations',
            ],
        ],
    ],
    'modules'             => [
    ]
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;

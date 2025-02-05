<?php

$config = [
    'id'         => 'basic',
    'basePath'   => dirname(__DIR__),
    'components' => [
        'request'      => [
            'cookieValidationKey' => '9RA9ZOFqFSOcteHzwnGWSupw5LHvssOm',
        ],
        'user'         => [
            'identityClass'   => 'app\modules\user\models\User',
            'enableAutoLogin' => true,
            'loginUrl'        => ['/user/default/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/default/error',
        ],
        'urlManager'   => [
            'rules' => require __DIR__ . DIRECTORY_SEPARATOR . 'rules.php',
        ],
    ],
    'modules'    => [
        'site' => [
            'class' => 'app\modules\site\Module',
        ],
        'user' => [
            'class' => 'app\modules\user\Module',
        ],
    ],
];

$params = \yii\helpers\ArrayHelper::merge(
    require(__DIR__ . DIRECTORY_SEPARATOR . 'params.php'),
    require(__DIR__ . DIRECTORY_SEPARATOR . 'params-local.php')
);

$config['components']['view'] = [
    'theme' => [
        'basePath' => '@app/themes/copytemplate',
        'baseUrl'  => '@web/themes/copytemplate',
        'pathMap'  => [
            '@app/views' => '@app/themes/copytemplate/views',
        ],
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][]      = 'debug';
    $config['modules']['debug'] = [
        'class'      => 'yii\debug\Module',
        'allowedIPs' => ['127.0.0.1', '192.168.*.*', '::1'],
    ];

    $config['bootstrap'][]    = 'gii';
    $config['modules']['gii'] = [
        'class'      => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '192.168.*.*', '::1'],
    ];

    $config['components']['assetManager'] = [
        'class'           => 'yii\web\AssetManager',
        'appendTimestamp' => true,
        'linkAssets'      => true,
    ];

}

return $config;

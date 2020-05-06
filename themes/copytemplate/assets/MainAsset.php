<?php

namespace app\themes\copytemplate\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since  2.0
 */
class MainAsset extends AssetBundle {
    public $sourcePath = '@app/themes/copytemplate';
    public $css        = [
        'css/clear.css',
        'https://www.diary.ru/style/fonts/i-diary/style.css',
        'https://static.diary.ru/style/2018/style.min.css',
        'https://static.diary.ru/style/2018/style.add.css',
    ];
    public $js         = [
    ];
    public $depends    = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}

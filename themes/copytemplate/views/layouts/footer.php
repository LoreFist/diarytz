<?php

use yii\bootstrap\Html;

?>
<div class="footer">
    <div class="container">
        <div class="copy">
            <noindex>
                <p>
                    <nobr>© 2002 — <?= date('Y') ?></nobr>
                    <nobr><?= Yii::t('app', 'Diary.ru') ?></nobr>
                </p>
            </noindex>
        </div>

        <div class="aside">
            <p>
                <?= Html::a(Yii::t('app', 'Реклама'), 'mailto:' . Yii::$app->params['contactAds']) ?>
                <noindex>
                    <?= Html::a(Yii::t('app', 'API'), Yii::$app->params['urlAPI'], ['rel' => 'nofollow']) ?>
                </noindex>
                <?= Html::a(Yii::t('app', Yii::$app->params['contactInfo']), 'mailto:' . Yii::$app->params['contactInfo']) ?>
                <?= Html::a(Yii::t('app', '18+'),
                    'https://info.diary.ru/index.php?title=%D0%9F%D1%80%D0%B0%D0%B2%D0%B8%D0%BB%D0%B0_%D0%B4%D0%BD%D0%B5%D0%B2%D0%BD%D0%B8%D0%BA%D0%BE%D0%B2') ?>
            </p>

        </div>
    </div>
</div>
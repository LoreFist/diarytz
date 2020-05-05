<?php

namespace app\modules\user\controllers;

use yii\filters\VerbFilter;
use yii\web\Controller;

class DefaultController extends Controller {
    /**
     * {@inheritdoc}
     */
    public function behaviors() {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

}
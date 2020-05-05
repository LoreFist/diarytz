<?php

namespace app\modules\site\controllers;

use yii\web\Controller;

class DefaultController extends Controller {

    /**
     * {@inheritdoc}
     */
    public function actions() {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Lists all User models.
     *
     * @return mixed
     */
    public function actionIndex() {

        return $this->render('index');
    }
}
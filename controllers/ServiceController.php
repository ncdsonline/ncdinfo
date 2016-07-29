<?php

namespace app\controllers;
// use Yii;


class ServiceController extends \yii\web\Controller {
   public function actionIndex() {
        return $this->render('index');
    }
}
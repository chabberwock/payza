<?php

namespace chabberwock\payza\controllers;

use yii\web\Controller;

class IpnController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}

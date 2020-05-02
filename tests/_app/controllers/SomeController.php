<?php

namespace app\controllers;

use drtsb\yii\seo\behaviors\SeoBehavior;
use yii\web\Controller;

class SomeController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            SeoBehavior::class,
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionAction()
    {
        return $this->render('action');
    }
}

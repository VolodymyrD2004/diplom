<?php

namespace app\modules\store\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class ProductController extends Controller
{
    /**
     * Displays product page.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        return $this->render('index', ['product' => \app\models\Product::findOne($id)]);
    }
}

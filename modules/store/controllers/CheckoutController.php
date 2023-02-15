<?php

namespace app\modules\store\controllers;

use app\modules\store\models\ProductSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class CheckoutController extends Controller
{

    /**
     * Displays checkout page.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render(
            'index',
        );
    }
}

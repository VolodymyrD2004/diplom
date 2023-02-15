<?php

namespace app\modules\admin\controllers;

use app\modules\stores\core\models\StatisticsService;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;


class DefaultController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only'  => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],

        ];
    }

    public function actionIndex()
    {
        return $this->render('index', [

        ]);
    }

}

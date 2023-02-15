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

class CategoryController extends Controller
{

    /**
     * Displays category page.
     *
     * @return string
     */
    public function actionIndex($id)
    {
        $category = \app\models\Category::findOne($id);
        $searchModel  = new ProductSearch();
        $searchModel->category_id = $id;
        $dataProvider = $searchModel->search($this->request->queryParams);


        return $this->render(
            'index',
            [
                'category'     => $category,
                'searchModel'  => $searchModel,
                'dataProvider' => $dataProvider,
                ]
        );
    }
}

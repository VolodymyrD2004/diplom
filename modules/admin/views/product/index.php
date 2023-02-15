<?php

use app\models\Product;
use yii\bootstrap5\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ProductSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Product'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            //'sku',
            [
                'attribute' => 'sku',
                'format' => 'raw',
                'content'   => function (Product $model) {
                    return Yii::$app->controller->renderPartial('_sku', ['model' => $model]);
                },
            ],
            //'category_id',
            [
                'attribute' => 'title',
                'format' => 'raw',
                'content'   => function (Product $model) {
                    return Yii::$app->controller->renderPartial('_title', ['model' => $model]);
                },
            ],
            [
                'attribute' => 'category_id',
                'format' => 'raw',
                'label' => Yii::t('app', 'Category'),
                'filter' => \app\models\Category::list(),
                'content'   => function (Product $model) {
                    return Html::a(
                        $model->category->title,
                        $model->category->getPublicUrl(),
                        [
                            'target'    => '_blank',
                            'data-pjax' => 0,
                        ]
                    );
                },
            ],
//            [
//                'attribute' => 'price',
//                'content'   => function (Product $model) {
//                    return Yii::$app->formatter->asCurrency($model->price, 'UAH');
//                },
//            ],

            //'quantity',
            //'show',
            //'brand_title',
            //'description',
            //'image',
            //'url:url',
            [
                'class' => ActionColumn::class,
                'urlCreator' => function ($action, Product $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>

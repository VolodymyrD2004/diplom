<?php

use app\models\Category;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\CategorySearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title                   = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(
            Yii::t('app', 'Create Category'),
            ['create'],
            ['class' => 'btn btn-success']
        ) ?>
    </p>

    <?php
    Pjax::begin(); ?>
    <?php
    // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget(
        [
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns'      => [
                //['class' => 'yii\grid\SerialColumn'],

                //'id',
                //'title',
                [
                    'attribute' => 'title',
                    'format' => 'raw',
                    'content'   => function (Category $model) {
                        return Yii::$app->controller->renderPartial('_title', ['model' => $model]);
                    },
                ],
                [
                    'attribute' => 'url',
                    'content'   => function (Category $model) {
                        return Html::a(
                            $model->url,
                            $model->getPublicUrl(),
                            [
                                'target'    => '_blank',
                                'data-pjax' => 0,
                            ]
                        );
                    },
                ],
                //'url:url',
                //'image',
                [
                    'class'      => ActionColumn::class,
                    'urlCreator' => function ($action, Category $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                ],
            ],
        ]
    ); ?>

    <?php
    Pjax::end(); ?>

</div>

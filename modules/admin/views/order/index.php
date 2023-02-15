<?php

use app\models\Order;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\OrderSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title                   = Yii::t('app', 'Orders');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>


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
                //'phone',
                //'name',
                'created_at',
                [
                    'attribute' => 'status',
                    'label'     => Yii::t('app', 'Status'),
                    'filter'    => Order::statusList(),
                    'content'   => function (Order $model) {
                        return Order::statusList()[$model->status];
                    },
                ],
                [
                    'label'     => Yii::t('app', 'Info'),
                    'filter'    => Order::statusList(),
                    'format' =>'raw',
                    'content'   => function (Order $model) {
                        return Yii::$app->controller->renderPartial('_info', ['model' => $model]);
                    },
                ],
                //'client_sid',
                [
                    'class'      => ActionColumn::class,
                    'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    },
                ],

            ],
        ]
    ); ?>

    <?php
    Pjax::end(); ?>

</div>

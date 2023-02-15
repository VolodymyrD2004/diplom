<?php

use yii\bootstrap5\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Product $model */

$this->title                   = $model->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data'  => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method'  => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget(
        [
            'model'      => $model,
            'attributes' => [
                'id',
                'sku',
                [
                    'attribute' => 'category_id',
                    'label'     => Yii::t('app', 'Category'),
                    'format'    => 'raw',
                    'value'     => function (\app\models\Product $model) {
                        return $model->category->title;
                    },
                ],
                'title',
                [
                    'attribute' => 'price',
                    'format'    => 'raw',
                    'value'     => function (\app\models\Product $model) {
                        return Yii::$app->formatter->asCurrency($model->price, 'UAH');
                    },
                ],
                'quantity',
                [
                    'attribute' => 'show',
                    'format'    => 'raw',
                    'value'     => function (\app\models\Product $model) {
                        return $model->show ? Yii::t('app', 'Yes') : Yii::t('app', 'No');
                    },
                ],
                //'show',
                'brand_title',
                [
                    'attribute' => 'description',
                    'format'    => 'raw',
                    'value'     => function (\app\models\Product $model) {
                        return $model->description;
                    },
                ],
                [
                    'attribute' => 'image',
                    'format'    => 'raw',
                    'value'     => function (\app\models\Product $model) {
                        return Html::img($model->getImageUrl(), ['style' => 'max-width: 200px;']);
                    },
                ],
                [
                    'attribute' => 'url',
                    'format'    => 'raw',
                    'value'     => function (\app\models\Product $model) {
                        return Html::a($model->getPublicUrl(), $model->getPublicUrl());
                    },
                ],
            ],
        ]
    ) ?>

</div>

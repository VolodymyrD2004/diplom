<?php

/**
 * @var \app\models\Product $model
 */

?>


<h5><?= \yii\helpers\Html::a($model->title, $model->getPublicUrl()) ?></h5>
<table class="table table-responsive">
    <tr>
        <td style="width: 30%"><?= Yii::t('app', 'Brand Title') ?></td>
        <td><?= $model->brand_title ?></td>
    </tr>
    <tr>
        <td><?= Yii::t('app', 'Price') ?></td>
        <td><?= Yii::$app->formatter->asCurrency($model->price, 'UAH') ?></td>
    </tr>
    <tr>
        <td><?= Yii::t('app', 'Quantity') ?></td>
        <td><?= $model->quantity ?></td>
    </tr>

</table>

<?php

/**
 * @var \app\models\Product $model
 */

?>

<div>
    <?= $model->sku ?>
</div>
<?= \yii\helpers\Html::img($model->getImageUrl(), ['class' => "img-thumbnail", 'style' => 'max-height: 150px;']) ?>

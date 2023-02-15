<?php

/**
 * @var \app\models\Category $model
 * @var \yii\web\View $this
 */

?>

<div class="row">
    <div class="col-6">
        <?= \yii\helpers\Html::img($model->getImageUrl(), ['class' => "img-thumbnail", 'style' => 'max-height:150px;'])?>
    </div>

    <div class="col-6">
        <h3 class="pt-3"><?= $model->title?></h3>
    </div>
</div>
<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="category-form">

    <?php
    $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?php
    //= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?php
    if ( ! empty($model->image)): ?>
        <div><?= Yii::t('app', 'Current image') ?>
            <?= Html::img($model->getImageUrl(), ['class' => "img-thumbnail"]) ?>
        </div>
    <?php
    endif; ?>

    <?= $form->field($model, 'imageFile')->fileInput(['accept' => "image/*"])
             ->label(
                 '<i class="fa fa-4x fa-file-image-o"></i> ' . Yii::t('app', 'Image'),
                 [
                     'title' => Yii::t('app', 'Image'),
                 ]
             ) ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php
    ActiveForm::end(); ?>

</div>

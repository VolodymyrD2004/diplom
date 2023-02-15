<?php

use mihaildev\ckeditor\CKEditor;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */

$this->registerJsFile('/js/translit.js', ['position' => \yii\web\View::POS_END]);
?>

<div class="product-form">

    <?php
    $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'category_id')
                     ->label(Yii::t('app', 'Category'))
                     ->dropDownList(\app\models\Category::list()) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'brand_title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>


    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($model, 'description')->widget(CKEditor::class, [
                'editorOptions' => [
                    'height' => 300,
                    'preset' => 'standard',
                    //разработанны стандартные настройки basic, standard, full данную возможность не обязательно использовать
                    'inline' => false,
                    //по умолчанию false
                ],
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <?= $form->field($model, 'price')->textInput(['type' => 'number', "min" => 0, "step" => 0.01]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'quantity')->textInput(['type' => 'number', 'min' => 0, 'step' => 1]) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($model, 'show')->checkbox() ?>
        </div>
    </div>

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

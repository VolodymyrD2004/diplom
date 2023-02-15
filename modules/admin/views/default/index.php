<?php

use yii\bootstrap5\Html;
use yii\web\View;

/**
 * @var $this       yii\web\View
 */
$this->title = 'Dashboard';
//$this->params['breadcrumbs'][] = $this->title;


?>
<div class="container pt-5">

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header>">
                        <h2>
                            <?= Yii::t('app', 'Categories') ?>
                        </h2>
                    </div>
                    <div>
                        <?= Yii::t('app', 'Editing product categories for display on a public page') ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?= Html::a(Yii::t('app', 'Edit'), ['category/index'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header>">
                        <h2>
                            <?= Yii::t('app', 'Products') ?>
                        </h2>
                    </div>
                    <div>
                        <?= Yii::t('app', 'Editing products for display on a public page') ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?= Html::a(Yii::t('app', 'Edit'), ['product/index'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <div class="card-header>">
                        <h2>
                            <?= Yii::t('app', 'Orders') ?>
                        </h2>
                    </div>
                    <div>
                        <?= Yii::t('app', 'Viewing and working with orders from customers') ?>
                    </div>
                </div>
                <div class="card-footer">
                    <?= Html::a(Yii::t('app', 'Work'), ['order/index'], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    </div>
</div>

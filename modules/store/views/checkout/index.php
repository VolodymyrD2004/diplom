<?php

use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/**
 * @var $this       yii\web\View
 *
 */
$this->title                   = Yii::t('public', 'Checkout');
$this->params['breadcrumbs'][] = $this->title;

$cart = Yii::$app->cart;

?>


<div class="breadcrumb">
    <div class="container">

        <?php

        if ( ! empty($this->params['breadcrumbs'])): ?>
            <div class="breadcrumb-inner">
                <?= Breadcrumbs::widget(
                    [
                        'options' => ['class' => 'list-inline list-unstyled', 'style' => "white-space: nowrap;"],
                        'links'   => $this->params['breadcrumbs'],
                    ]
                ) ?>
            </div>
        <?php
        endif ?>
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content outer-top-xs">
    <div class="container">
        <div class="row ">
            <div class="shopping-cart">
                <div class="shopping-cart-table ">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="cart-romove item"><?= Yii::t('public', 'Remove') ?></th>
                                <th class="cart-description item"><?= Yii::t('public', 'Image') ?></th>
                                <th class="cart-product-name item"><?= Yii::t('public', 'Title') ?></th>
                                <th class="cart-qty item"><?= Yii::t('public', 'Price') ?></th>
                                <th class="cart-qty item"><?= Yii::t('public', 'Quantity') ?></th>
                                <th class="cart-sub-total item"><?= Yii::t('public', 'Subtotal') ?></th>
                            </tr>
                            </thead><!-- /thead -->
                            <tbody>
                            <?php
                            foreach ($cart->getItems() as $orderItem): ?>
                                <tr>
                                    <td class="romove-item">
                                        <form method="post">
                                            <button type="submit" class="icon btn btn-outline-">
                                    <span class="fa fa-trash-o">
                                            </button>
                                            <input style="display: none" name="<?= Yii::$app->request->csrfParam; ?>"
                                                   type="hidden" value="<?= Yii::$app->request->csrfToken; ?>">
                                            <input style="display: none" name="action" type="hidden"
                                                   value="remove-from-cart-all">
                                            <input style="display: none" name="productId" type="hidden"
                                                   value="<?= $orderItem->product_id ?>">
                                        </form>
                                    </td>
                                    <td class="cart-image">
                                        <a class="entry-thumbnail" href="<?= $orderItem->product->getPublicUrl() ?>">
                                            <img src="<?= $orderItem->product->getImageUrl() ?>" alt="">
                                        </a>
                                    </td>
                                    <td class="cart-product-name-info">
                                        <h4 class='cart-product-description'>
                                            <a href="<?= $orderItem->product->getPublicUrl() ?>">
                                                <?= $orderItem->product->title ?>
                                            </a>
                                        </h4>
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="rating rateit-small"></div>
                                            </div>
                                        </div><!-- /.row -->
                                        <div class="cart-product-info">

                                        </div>
                                    </td>
                                    <td class="cart-product-sub-total">
                                        <span class="cart-sub-total-price">
                                            <?= Yii::$app->formatter->asCurrency(
                                                $orderItem->price,
                                                'UAH'
                                            ) ?>
                                        </span>
                                    </td>
                                    <td class="cart-product-quantity">

                                        <div class="quant-input">
                                            <div class="arrows">
                                                <form class="arrow plus gradient" method="post">
                                                    <span class="ir">
                                                    <button style="background: transparent; border: none;"
                                                            data-toggle="tooltip"
                                                            type="submit"
                                                            title="+">
                                                        <i class="icon fa fa-sort-asc"></i>
                                                    </button>
                                                    </span>
                                                    <input style="display: none" name="<?= Yii::$app->request->csrfParam; ?>" type="hidden" value="<?= Yii::$app->request->csrfToken; ?>">
                                                    <input style="display: none" name="action" type="hidden" value="add-to-cart">
                                                    <input style="display: none" name="quantity" type="hidden" value="1">
                                                    <input style="display: none" name="productId" type="hidden" value="<?=$orderItem->product_id?>">
                                                </form>
                                                <form class="arrow minus gradient" method="post">
                                                    <span class="ir">
                                                    <button style="background: transparent; border: none;" data-toggle="tooltip"
                                                            type="submit"
                                                            title="-">
                                                        <i class="icon fa fa-sort-desc"></i>
                                                    </button>
                                                    </span>
                                                    <input style="display: none" name="<?= Yii::$app->request->csrfParam; ?>" type="hidden" value="<?= Yii::$app->request->csrfToken; ?>">
                                                    <input style="display: none" name="action" type="hidden" value="remove-from-cart">
                                                    <input style="display: none" name="productId" type="hidden" value="<?=$orderItem->product_id?>">
                                                </form>
                                            </div>
                                            <input style="height: 38px;" disabled type="text" value="<?= $orderItem->quantity?>">
                                        </div>

                                    </td>

                                    <td class="cart-product-sub-total">
                                        <span class="cart-sub-total-price">
                                            <?= Yii::$app->formatter->asCurrency(
                                                $orderItem->quantity * $orderItem->price,
                                                'UAH'
                                            ) ?>
                                        </span>
                                    </td>
                                </tr>

                            <?php
                            endforeach; ?>

                            </tbody><!-- /tbody -->
                        </table><!-- /table -->
                    </div>
                </div><!-- /.shopping-cart-table -->
                <div class="col-md-4 col-sm-12 estimate-ship-tax">
                    <a href="<?= \yii\helpers\Url::toRoute('/') ?>"
                       class="btn btn-upper btn-primary outer-left-xs">
                        <?= Yii::t('public', 'Continue shopping') ?>
                    </a>
                </div>
                <div class="col-md-4 col-sm-12 estimate-ship-tax"></div>


                <div class="col-md-4 col-sm-12 cart-shopping-total">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>
                                <!--                                <div class="cart-sub-total">-->
                                <!--                                    Subtotal<span class="inner-left-md">$600.00</span>-->
                                <!--                                </div>-->
                                <div class="cart-grand-total">
                                    <?= Yii::t('public', 'Total amount') ?><span class="inner-left-md">
                                        <?= Yii::$app->formatter->asCurrency(
                                            $cart->getTotalAmount(),
                                            'UAH'
                                        ) ?>
                                    </span>
                                </div>
                            </th>
                        </tr>
                        </thead><!-- /thead -->
                        <tbody>
                        <tr>
                            <td>
                                <div class="cart-checkout-btn pull-right">
                                    <button type="submit" class="btn btn-primary checkout-btn">
                                        <?= Yii::t('public', 'Pay') ?>
                                    </button>
                                    <span class=""></span>
                                </div>
                            </td>
                        </tr>
                        </tbody><!-- /tbody -->
                    </table><!-- /table -->
                </div><!-- /.cart-shopping-total -->            </div><!-- /.shopping-cart -->
        </div> <!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

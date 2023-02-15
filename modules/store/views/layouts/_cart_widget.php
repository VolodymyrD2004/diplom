<?php

$cart        = Yii::$app->cart;
$totalAmount = $cart->getTotalAmount();
$itemsCount  = $cart->getItemsCount();
?>

<div class="dropdown dropdown-cart">
    <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">

        <div class="items-cart-inner">
            <div class="basket"><i class="glyphicon glyphicon-shopping-cart"></i></div>
            <?php
            if ($itemsCount > 0): ?>
                <div class="basket-item-count"><span class="count"><?= $itemsCount ?></span></div>
            <?php
            endif; ?>
            <div class="total-price-basket">
                <span class="lbl"><?= Yii::t('public', 'Cart') ?>-</span>
                <span class="total-price">
                    <span class="value">
                        <?= Yii::$app->formatter->asCurrency($totalAmount, 'UAH') ?>
                    </span></span>
            </div>
        </div>
    </a>
    <ul class="dropdown-menu">
        <li>
            <div class="cart-item product-summary">
                <?php
                foreach ($cart->getItems() as $orderItem): ?>
                    <div class="row">
                        <div class="col-xs-4">
                            <div class="image"><a href="<?= $orderItem->product->getPublicUrl()?>"><img
                                            src="<?= $orderItem->product->getImageUrl()?>"
                                            alt=""></a></div>
                        </div>
                        <div class="col-xs-7">
                            <h3 class="name"><a href="<?= $orderItem->product->getPublicUrl()?>"><?=$orderItem->product->title?></a></h3>
                            <div class="price">
                                <?= Yii::$app->formatter->asCurrency($orderItem->price, 'UAH') ?>
                            </div>
                            <div> x <?= $orderItem->quantity?></div>
                        </div>
                        <div class="col-xs-1 action">
                            <form method="post">
                                <button type="submit" class="btn btn-outline-danger">
                                    <span class="fa fa-trash">
                                </button>
                                <input style="display: none" name="<?= Yii::$app->request->csrfParam; ?>" type="hidden" value="<?= Yii::$app->request->csrfToken; ?>">
                                <input style="display: none" name="action" type="hidden" value="remove-from-cart-all">
                                <input style="display: none" name="productId" type="hidden" value="<?=$orderItem->product_id?>">
                            </form>
<!--                            <a href="#"><i class="fa fa-trash"></i></a>-->
                        </div>
                    </div>
                <?php
                endforeach; ?>

            </div>
            <!-- /.cart-item -->
            <div class="clearfix"></div>
            <hr>
            <div class="clearfix cart-total">
                <div class="pull-right"><span class="text"><?= Yii::t('public', 'Total') ?> :</span><span
                            class='price'>
                        <?= Yii::$app->formatter->asCurrency($totalAmount, 'UAH') ?>
                    </span>
                </div>
                <div class="clearfix"></div>
                <a href="<?=\yii\helpers\Url::toRoute('/store/checkout/index')?>"
                   class="btn btn-upper btn-primary btn-block m-t-20"><?= Yii::t('public', 'Checkout') ?></a></div>
            <!-- /.cart-total-->

        </li>
    </ul>
    <!-- /.dropdown-menu-->
</div>

<?php

use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/**
 * @var $this       yii\web\View
 * @var $product    \app\models\Product
 *
 */
$this->title                   = $product->title;
$this->params['breadcrumbs'][] = [
    'label' => $product->category->title,
    'url'   => $product->category->getPublicUrl(),
];
$this->params['breadcrumbs'][] = $this->title;


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
    <div class='container'>
        <div class='row single-product'>
            <div class='col-md-12'>
                <div class="detail-block">
                    <div class="row  wow fadeInUp">

                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">
                                    <?php
                                    foreach ([$product->getImageUrl()] as $idx => $imageUrl): ?>
                                        <div class="single-product-gallery-item" id="slide<?= $idx ?>">
                                            <a data-lightbox="image-1" data-title="Gallery"
                                               href="<?= $imageUrl ?>">
                                                <img class="img-responsive" alt="" src="/public/images/blank.gif"
                                                     data-echo="<?= $imageUrl ?>"/>
                                            </a>
                                        </div><!-- /.single-product-gallery-item -->
                                    <?php
                                    endforeach; ?>
                                </div><!-- /.single-product-slider -->


                                <div class="single-product-gallery-thumbs gallery-thumbs">

                                    <div id="owl-single-product-thumbnails">

                                        <?php
                                        foreach ([$product->getImageUrl()] as $idx => $imageUrl): ?>
                                            <div class="item">
                                                <a class="horizontal-thumb active" data-target="#owl-single-product"
                                                   data-slide="1" href="#slide<?= $idx ?>">
                                                    <img class="img-responsive" width="85" alt=""
                                                         src="/public/images/blank.gif"
                                                         data-echo="<?= $imageUrl ?>"/>
                                                </a>
                                            </div>
                                        <?php
                                        endforeach; ?>

                                    </div><!-- /#owl-single-product-thumbnails -->


                                </div><!-- /.gallery-thumbs -->

                            </div><!-- /.single-product-gallery -->
                        </div><!-- /.gallery-holder -->
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name"><?= $product->title ?></h1>

                                <div class="rating-reviews m-t-20">
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="rating rateit-small"></div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.rating-reviews -->

                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <div class="stock-box">
                                                <span class="label"><?= Yii::t('public', 'Availability') ?> :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-9">
                                            <div class="stock-box">
                                                <?php
                                                if ($product->quantity > 0): ?>
                                                    <span class="value"><?= Yii::t('public', 'In Stock') ?> </span>
                                                <?php
                                                else: ?>
                                                    <span class="value"><?= Yii::t('public', 'Not Available') ?> </span>
                                                <?php
                                                endif; ?>

                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div><!-- /.stock-container -->

                                <div class="description-container m-t-20">
                                    <?= mb_strimwidth($product->description, 0, 400, "...") ?>
                                </div><!-- /.description-container -->

                                <div class="price-container info-container m-t-20">
                                    <div class="row">

                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                <span class="price">
                                                    <?= Yii::$app->formatter->asCurrency(
                                                        $product->price,
                                                        'UAH'
                                                    ) ?>
                                                </span>
                                                <span class="price-strike">
                                                    <?= Yii::$app->formatter->asCurrency(
                                                        $product->price + $product->price * 0.07,
                                                        'UAH'
                                                    ) ?>
                                                </span>
                                            </div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->

                                <form method="post">
                                    <input style="display: none" name="<?= Yii::$app->request->csrfParam; ?>"
                                           type="hidden" value="<?= Yii::$app->request->csrfToken; ?>">
                                    <input style="display: none" name="action" type="hidden" value="add-to-cart">
                                    <input style="display: none" name="productId" type="hidden"
                                           value="<?= $product->id ?>">

                                    <div class="quantity-container info-container">
                                        <div class="row">

                                            <div class="col-sm-2">
                                                <span class="label"><?= Yii::t('public', 'Quantity') ?> :</span>
                                            </div>

                                            <div class="col-sm-2">
                                                <div class="cart-quantity">
                                                    <div class="quant-input">
<!--                                                        <div class="arrows">-->
<!--                                                            <div class="arrow plus gradient"><span class="ir"><i-->
<!--                                                                            class="icon fa fa-sort-asc"></i></span>-->
<!--                                                            </div>-->
<!--                                                            <div class="arrow minus gradient"><span class="ir"><i-->
<!--                                                                            class="icon fa fa-sort-desc"></i></span>-->
<!--                                                            </div>-->
<!--                                                        </div>-->
                                                        <input type="number" name="quantity" value="1" min="1" step="1", max="<?=$product->quantity?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-sm-7">
                                                <button class="btn btn-primary" type="submit"><i
                                                            class="fa fa-shopping-cart inner-right-vs"></i>
                                                    <?= Yii::t('public', 'Add to cart') ?>
                                                </button>
                                            </div>


                                        </div><!-- /.row -->
                                    </div><!-- /.quantity-container -->
                                </form>

                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->
                </div>

                <div class="product-tabs inner-bottom-xs  wow fadeInUp">
                    <div class="row">
                        <div class="col-sm-3">
                            <ul id="product-tabs" class="nav nav-tabs nav-tab-cell">
                                <li class="active"><a data-toggle="tab" href="#description">
                                        <?= Yii::t('public', 'Description') ?>
                                    </a></li>
                                <li><a data-toggle="tab" href="#review"><?= Yii::t('public', 'Review') ?></a></li>
                            </ul><!-- /.nav-tabs #product-tabs -->
                        </div>
                        <div class="col-sm-9">

                            <div class="tab-content">

                                <div id="description" class="tab-pane in active">
                                    <div class="product-tab">
                                        <p class="text">
                                            <?= $product->description ?>
                                        </p>
                                    </div>
                                </div><!-- /.tab-pane -->

                                <div id="review" class="tab-pane">
                                    <div class="product-tab">

                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Phasellus posuere
                                            dictum elit, eu tincidunt dolor blandit vel. Donec dui tellus, egestas nec
                                            vulputate et, tincidunt ut ipsum. Mauris finibus eget tortor vel ultrices.
                                            Class aptent taciti sociosqu ad litora torquent per conubia nostra, per
                                            inceptos himenaeos. Suspendisse et ullamcorper urna, cursus vestibulum
                                            augue. In a nibh ac orci maximus varius ut sagittis sapien. Fusce congue
                                            lectus non urna faucibus accumsan. Mauris eu dui finibus, mattis leo eget,
                                            convallis mi. Fusce sit amet sapien vitae sapien ullamcorper lobortis.
                                            Integer scelerisque lectus quam, nec sagittis nunc blandit sit amet.</p>

                                        <p>Quisque venenatis feugiat mi, ac malesuada purus rutrum in. Nam venenatis
                                            neque ut lacus blandit, in suscipit neque bibendum. Curabitur in dui in nibh
                                            posuere egestas. Donec vitae hendrerit neque. Fusce quis nisi euismod,
                                            tempus nulla auctor, venenatis metus. Praesent non laoreet tortor. Aenean
                                            porttitor vulputate euismod. Sed quis neque non ex ultrices semper.</p>

                                    </div><!-- /.product-tab -->
                                </div><!-- /.tab-pane -->


                            </div><!-- /.tab-content -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.product-tabs -->


            </div><!-- /.col -->
            <div class="clearfix"></div>
        </div><!-- /.row -->
    </div><!-- /.container -->
</div><!-- /.body-content -->

<?php

use yii\bootstrap5\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;
use yii\widgets\LinkPager;

/**
 * @var $this         yii\web\View
 * @var $category     \app\models\Category
 * @var $searchModel  \app\modules\store\models\ProductSearch
 * @var $dataProvider \yii\data\ActiveDataProvider
 *
 */
$this->title                   = $category->title;
$this->params['breadcrumbs'][] = $this->title;

$products = $dataProvider->getModels();

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
<div class="body-content outer-top-xs" id="top-banner-and-menu">
    <div class="container">
        <div class="row">
            <!-- ============================================== SIDEBAR ============================================== -->
            <div class="col-xs-12 col-sm-12 col-md-3 sidebar">
                <?= $this->render('@app/modules/store/views/common/_sidebar', []) ?>
            </div>
            <!-- ============================================== SIDEBAR : END ============================================== -->

            <div class='col-md-9'>
                <!-- ========================================== SECTION – HERO ========================================= -->

                <div id="category" class="category-carousel hidden-xs">
                    <div class="item">
                        <div class="image"><img src="<?= $category->getImageUrl() ?>" alt=""
                                                style="width: 100%; max-height: 400px"
                                                class="img-responsive">
                            <div style="background-color: black; opacity: 0.5; position: absolute; top:0; left:0; right: 0; bottom: 0;"></div>
                        </div>
                        <div class="container-fluid">
                            <div class="caption vertical-top text-left">
                                <div class="big-text"> <?= $category->title ?> </div>
                                <div class="excerpt hidden-sm hidden-md"> <?= $category->title ?> </div>
                                <div class="excerpt-normal hidden-sm hidden-md"> <?= $category->title ?> </div>
                            </div>
                            <!-- /.caption -->
                        </div>
                        <!-- /.container-fluid -->
                    </div>
                </div>

                <div class="clearfix filters-container m-t-10">
                    <div class="row">
                        <div class="col col-sm-6 col-md-4">
                            <div class="filter-tabs">
                                <ul id="filter-tabs" class="nav nav-tabs nav-tab-box nav-tab-fa-icon">
                                    <li class="active"><a data-toggle="tab" href="#grid-container"><i
                                                    class="icon fa fa-th-large"></i><?= Yii::t('public','Grid')?></a></li>
                                    <li><a data-toggle="tab" href="#list-container"><i class="icon fa fa-th-list"></i><?= Yii::t('public','List')?></a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.filter-tabs -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-12 col-md-6">
                            <div class="col col-sm-3 col-md-6 ">
                                <div class="lbl-cnt"><span class="lbl"><?= Yii::t('public','Sort by')?></span>
                                    <?= $dataProvider->sort->link('title', [
                                        'label' => Yii::t('public','Title'),
                                    ])?>
                                    <?= $dataProvider->sort->link('price', [
                                        'label' => Yii::t('public','Price'),
                                    ])?>
                                    <!-- /.fld -->
                                </div>
                                <!-- /.lbl-cnt -->
                            </div>
                            <!-- /.col -->
<!--                            <div class="col col-sm-3 col-md-6 no-padding">-->
<!--                                <div class="lbl-cnt"><span class="lbl">Show</span>-->
<!--                                    <div class="fld inline">-->
<!--                                        <div class="dropdown dropdown-small dropdown-med dropdown-white inline">-->
<!--                                            <button data-toggle="dropdown" type="button" class="btn dropdown-toggle"> 1-->
<!--                                                <span class="caret"></span></button>-->
<!--                                            <ul role="menu" class="dropdown-menu">-->
<!--                                                <li role="presentation"><a href="#">1</a></li>-->
<!--                                                <li role="presentation"><a href="#">2</a></li>-->
<!--                                                <li role="presentation"><a href="#">3</a></li>-->
<!--                                                <li role="presentation"><a href="#">4</a></li>-->
<!--                                                <li role="presentation"><a href="#">5</a></li>-->
<!--                                                <li role="presentation"><a href="#">6</a></li>-->
<!--                                                <li role="presentation"><a href="#">7</a></li>-->
<!--                                                <li role="presentation"><a href="#">8</a></li>-->
<!--                                                <li role="presentation"><a href="#">9</a></li>-->
<!--                                                <li role="presentation"><a href="#">10</a></li>-->
<!--                                            </ul>-->
<!--                                        </div>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->
                            <!-- /.col -->
                        </div>
                        <!-- /.col -->
                        <div class="col col-sm-6 col-md-4 text-right">
                            <div class="pagination-container">
                                <?=

                                LinkPager::widget(
                                    [
                                            'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
                                            'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                                            'options' => ['class' => 'list-inline list-unstyled'],
                                        'pagination' => $dataProvider->pagination,
                                    ]
                                ); ?>

                                <!-- /.list-inline -->
                            </div>
                            <!-- /.pagination-container --> </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="search-result-container ">
                    <div id="myTabContent" class="tab-content category-list">
                        <div class="tab-pane active " id="grid-container">
                            <div class="category-product">
                                <div class="row">
                                    <?php
                                    foreach ($products as $product): ?>
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a href="<?= $product->getPublicUrl() ?>">
                                                                <img src="<?= $product->getImageUrl() ?>"
                                                                     alt="<?= $product->title ?>"></a>
                                                        </div>
                                                        <!-- /.image -->

                                                        <div class="tag new"><span>new</span></div>
                                                    </div>
                                                    <!-- /.product-image -->

                                                    <div class="product-info text-left">
                                                        <h3 class="name"><a href="<?= $product->getPublicUrl() ?>">
                                                                <?= $product->title ?>
                                                            </a></h3>
                                                        <div class="rating rateit-small" data-rateit-value="5"></div>
                                                        <div class="description"></div>
                                                        <div class="product-price">
                                                            <span class="price">
                        <?= Yii::$app->formatter->asCurrency(
                            $product->price,
                            'UAH'
                        ) ?>
                    </span>
                                                            <span class="price-before-discount">
                            <?= Yii::$app->formatter->asCurrency(
                                $product->price + $product->price * 0.07,
                                'UAH'
                            ) ?>
                                </span>
                                                        </div>
                                                        <!-- /.product-price -->

                                                    </div>
                                                    <!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <ul class="list-unstyled">
                                                                <li class="add-cart-button btn-group">
                                                                    <form method="post">
                                                                        <button data-toggle="tooltip"
                                                                                class="btn btn-primary icon" type="submit"
                                                                                title="Add Cart"><i
                                                                                    class="fa fa-shopping-cart"></i></button>
                                                                        <input style="display: none" name="<?= Yii::$app->request->csrfParam; ?>" type="hidden" value="<?= Yii::$app->request->csrfToken; ?>">
                                                                        <input style="display: none" name="action" type="hidden" value="add-to-cart">
                                                                        <input style="display: none" name="productId" type="hidden" value="<?=$product->id?>">
                                                                        <button class="btn btn-primary cart-btn" type="submit">
                                                                            <?= Yii::t('public', 'Add to cart')?>
                                                                        </button>
                                                                    </form>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                        <!-- /.action -->
                                                    </div>
                                                    <!-- /.cart -->
                                                </div>
                                                <!-- /.product -->

                                            </div>
                                            <!-- /.products -->
                                        </div>
                                    <?php
                                    endforeach; ?>
                                    <!-- /.item -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.category-product -->

                        </div>
                        <!-- /.tab-pane -->

                        <div class="tab-pane " id="list-container">
                            <div class="category-product">
                                <?php
                                foreach ($products as $product): ?>
                                    <div class="category-product-inner wow fadeInUp">
                                        <div class="products">

                                            <div class="product-list product">
                                                <div class="row product-list-row">
                                                    <div class="col col-sm-4 col-lg-4">
                                                        <div class="product-image">
                                                            <div class="image">
                                                                <img src="<?= $product->getImageUrl() ?>"
                                                                     alt="<?= $product->title ?>">
                                                            </div>
                                                        </div>
                                                        <!-- /.product-image -->
                                                    </div>
                                                    <!-- /.col -->
                                                    <div class="col col-sm-8 col-lg-8">
                                                        <div class="product-info">
                                                            <h3 class="name"><a href="<?= $product->getPublicUrl(
                                                                ) ?>"><?= $product->title ?></a></h3>
                                                            <div class="rating rateit-small"></div>
                                                            <div class="product-price">
                                                           <span class="price">
                        <?= Yii::$app->formatter->asCurrency(
                            $product->price,
                            'UAH'
                        ) ?>
                    </span>
                                                                <span class="price-before-discount">
                            <?= Yii::$app->formatter->asCurrency(
                                $product->price + $product->price * 0.07,
                                'UAH'
                            ) ?>
                                </span>
                                                            </div>
                                                            <!-- /.product-price -->
                                                            <div class="description m-t-10">
                                                                <?= $product->description ?>
                                                            </div>
                                                            <div class="cart clearfix animate-effect">
                                                                <div class="action">
                                                                    <ul class="list-unstyled">
                                                                        <li class="add-cart-button btn-group">
                                                                            <form method="post">
                                                                                <button data-toggle="tooltip"
                                                                                        class="btn btn-primary icon" type="submit"
                                                                                        title="Add Cart"><i
                                                                                            class="fa fa-shopping-cart"></i>

                                                                                        <?= Yii::t('public', 'Add to cart')?>

                                                                                </button>
                                                                                <input style="display: none" name="<?= Yii::$app->request->csrfParam; ?>" type="hidden" value="<?= Yii::$app->request->csrfToken; ?>">
                                                                                <input style="display: none" name="action" type="hidden" value="add-to-cart">
                                                                                <input style="display: none" name="productId" type="hidden" value="<?=$product->id?>">
                                                                            </form>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                                <!-- /.action -->
                                                            </div>
                                                            <!-- /.cart -->

                                                        </div>
                                                        <!-- /.product-info -->
                                                    </div>
                                                    <!-- /.col -->
                                                </div>
                                                <!-- /.product-list-row -->
                                                <div class="tag new"><span>new</span></div>
                                            </div>
                                            <!-- /.product-list -->
                                        </div>
                                        <!-- /.products -->
                                    </div>
                                    <!-- /.category-product-inner -->
                                <?php
                                endforeach; ?>


                            </div>
                            <!-- /.category-product -->
                        </div>
                        <!-- /.tab-pane #list-container -->
                    </div>
                    <!-- /.tab-content -->
                    <div class="clearfix filters-container">
                        <div class="text-right">
                            <div class="pagination-container">


                                <?=

                                LinkPager::widget(
                                    [
                                        'prevPageLabel' => '<i class="fa fa-angle-left"></i>',
                                        'nextPageLabel' => '<i class="fa fa-angle-right"></i>',
                                        'options' => ['class' => 'list-inline list-unstyled'],
                                        'pagination' => $dataProvider->pagination,
                                    ]
                                ); ?>
                                <!-- /.list-inline -->
                            </div>
                            <!-- /.pagination-container --> </div>
                        <!-- /.text-right -->

                    </div>
                    <!-- /.filters-container -->

                </div>
                <!-- /.search-result-container -->

            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container -->
</div>

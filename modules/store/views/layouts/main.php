<?php

/** @var yii\web\View $this */

/** @var string $content */

use yii\helpers\Html;

$asset = \app\modules\store\assets\Asset::register($this);
$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => '@web/favicon.ico']);

?>
<?php
$this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">
    <head>
        <title><?= Html::encode($this->title) ?></title>
        <?php
        $this->head() ?>
    </head>
    <body class="cnt-home">
    <?php
    $this->beginBody() ?>
    <!-- ============================================== HEADER ============================================== -->
    <header class="header-style-1">


        <!-- /.header-top -->
        <!-- ============================================== TOP MENU : END ============================================== -->
        <div class="main-header">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                        <!-- ============================================================= LOGO ============================================================= -->
                        <div class="logo"><a href="/"> <img src="<?= $asset->baseUrl . '/images/logo-shop.png' ?>"
                                                            style="max-height: 48px;" alt="logo"> </a></div>
                        <!-- /.logo -->
                        <!-- ============================================================= LOGO : END ============================================================= -->
                    </div>
                    <!-- /.logo-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-5 top-search-holder">
                        <!-- /.contact-row -->
                        <!-- ============================================================= SEARCH AREA ============================================================= -->
                        <!--                    <div class="search-area">-->
                        <!--                        <form>-->
                        <!--                            <div class="control-group">-->
                        <!--                                <ul class="categories-filter animate-dropdown">-->
                        <!--                                    <li class="dropdown"> <a class="dropdown-toggle"  data-toggle="dropdown" href="category.html">Categories <b class="caret"></b></a>-->
                        <!--                                        <ul class="dropdown-menu" role="menu" >-->
                        <!--                                            <li class="menu-header">Computer</li>-->
                        <!--                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>-->
                        <!--                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>-->
                        <!--                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>-->
                        <!--                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>-->
                        <!--                                        </ul>-->
                        <!--                                    </li>-->
                        <!--                                </ul>-->
                        <!--                                <input class="search-field" placeholder="Search here..." />-->
                        <!--                                <a class="search-button" href="#" ></a> </div>-->
                        <!--                        </form>-->
                        <!--                    </div>-->
                        <!-- /.search-area -->
                        <!-- ============================================================= SEARCH AREA : END ============================================================= --> </div>
                    <!-- /.top-search-holder -->

                    <div class="col-xs-12 col-sm-12 col-md-4 animate-dropdown top-cart-row">
                        <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                        <?= $this->render('_cart_widget')?>


                        <!-- /.dropdown-cart -->

                        <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                    </div>
                    <!-- /.top-cart-row -->
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container -->

        </div>
        <!-- /.main-header -->

        <!-- ============================================== NAVBAR ============================================== -->
        <div class="header-nav animate-dropdown">
            <div class="container">
                <div class="yamm navbar navbar-default" role="navigation">
                    <div class="navbar-header">
                        <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse"
                                class="navbar-toggle collapsed" type="button">
                            <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span
                                    class="icon-bar"></span> <span class="icon-bar"></span></button>
                    </div>
                    <div class="nav-bg-class">
                        <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                            <div class="nav-outer">
                                <ul class="nav navbar-nav">
                                    <li class="active dropdown yamm-fw">
                                        <a href="<?= \yii\helpers\Url::to(['/store/default/index']) ?>"
                                           data-hover="dropdown"
                                           class="dropdown-toggle" data-toggle="dropdown">
                                            <?= Yii::$app->name ?>
                                        </a>
                                    </li>
                                    <li class="dropdown yamm mega-menu"><a href="home.html" data-hover="dropdown"
                                                                           class="dropdown-toggle"
                                                                           data-toggle="dropdown">
                                            <?= Yii::t('public','Categories') ?> <span class="menu-label hot-menu hidden-xs">hot</span></a>
                                        <ul class="dropdown-menu container">
                                            <li>
                                                <div class="yamm-content ">
                                                    <div class="row">
                                                        <div class="col-xs-12 col-sm-6 col-md-2 col-menu">
                                                            <h2 class="title"><?= Yii::t(
                                                                    'public',
                                                                    'Top categories'
                                                                ) ?></h2>
                                                            <ul class="links">
                                                                <?php
                                                                foreach (
                                                                    \app\models\Category::find()
                                                                                        ->orderBy('title')
                                                                                        ->all() as $category
                                                                ): ?>

                                                                    <li><a href="<?= $category->getPublicUrl(
                                                                        ) ?>"><?= $category->title ?></a></li>
                                                                <?php
                                                                endforeach; ?>
                                                            </ul>
                                                        </div>
                                                        <!-- /.col -->


                                                        <!-- /.yamm-content -->
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                                <!-- /.navbar-nav -->
                                <div class="clearfix"></div>
                            </div>
                            <!-- /.nav-outer -->
                        </div>
                        <!-- /.navbar-collapse -->

                    </div>
                    <!-- /.nav-bg-class -->
                </div>
                <!-- /.navbar-default -->
            </div>
            <!-- /.container-class -->

        </div>
        <!-- /.header-nav -->
        <!-- ============================================== NAVBAR : END ============================================== -->

    </header>
    <!-- ============================================== HEADER : END ============================================== -->

    <?= $content ?>


    <!-- ============================================================= FOOTER ============================================================= -->
    <footer id="footer" class="footer color-bg">
        <div class="footer-bottom">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-sm-6 col-md-3">
                        <div class="module-heading">
                            <h4 class="module-title"><?= Yii::t('public', 'Contact us') ?></h4>
                        </div>
                        <!-- /.module-heading -->

                        <div class="module-body">
                            <ul class="toggle-footer" style="">
                                <li class="media">
                                    <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                    class="fa fa-map-marker fa-stack-1x fa-inverse"></i> </span></div>
                                    <div class="media-body">
                                        <p>Україна</p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                    class="fa fa-mobile fa-stack-1x fa-inverse"></i> </span></div>
                                    <div class="media-body">
                                        <p>+38 (050) 432-77-87<br>
                                            </p>
                                    </div>
                                </li>
                                <li class="media">
                                    <div class="pull-left"><span class="icon fa-stack fa-lg"> <i
                                                    class="fa fa-envelope fa-stack-1x fa-inverse"></i> </span></div>
                                    <div class="media-body"><span><a href="#">sales@d-shop.com</a></span></div>
                                </li>
                            </ul>
                        </div>
                        <!-- /.module-body -->
                    </div>
                    <!-- /.col -->

                </div>
            </div>
            <div class="copyright-bar">
                <div class="container">
                    <div class="col-xs-12 col-sm-6 no-padding social">
                        <ul class="link">
                            <li class="fb pull-left"><a target="_blank" rel="nofollow" href="#" title="Facebook"></a>
                            </li>
                            <li class="tw pull-left"><a target="_blank" rel="nofollow" href="#" title="Twitter"></a>
                            </li>
                            <li class="googleplus pull-left"><a target="_blank" rel="nofollow" href="#"
                                                                title="GooglePlus"></a>
                            </li>
                            <li class="rss pull-left"><a target="_blank" rel="nofollow" href="#" title="RSS"></a></li>
                            <li class="pintrest pull-left"><a target="_blank" rel="nofollow" href="#"
                                                              title="PInterest"></a>
                            </li>
                            <li class="linkedin pull-left"><a target="_blank" rel="nofollow" href="#"
                                                              title="Linkedin"></a></li>
                            <li class="youtube pull-left"><a target="_blank" rel="nofollow" href="#"
                                                             title="Youtube"></a></li>
                        </ul>
                    </div>
                    <div class="col-xs-12 col-sm-6 no-padding">
                        <div class="clearfix payment-methods">
                            <ul>
                                <li><img src="/public/images/payments/1.png" alt=""></li>
                                <li><img src="/public/images/payments/2.png" alt=""></li>
                                <li><img src="/public/images/payments/3.png" alt=""></li>
                                <li><img src="/public/images/payments/4.png" alt=""></li>
                                <li><img src="/public/images/payments/5.png" alt=""></li>
                            </ul>
                        </div>
                        <!-- /.payment-methods -->
                    </div>
                </div>
            </div>
    </footer>
    <!-- ============================================================= FOOTER : END============================================================= -->
    <?php
    $this->endBody() ?>

    </body>
    </html>
<?php
$this->endPage() ?>
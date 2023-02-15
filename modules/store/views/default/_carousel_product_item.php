<?php
/**
 * @var \app\models\Product $product
 */


?>

<div class="item item-carousel">
    <div class="products">
        <div class="product">
            <div class="product-image">
                <div class="image">
                    <a href="<?= $product->getPublicUrl() ?>">
                        <img src="<?= $product->getImageUrl() ?>" alt="<?= $product->title ?>">
                    </a>
                </div>
                <!-- /.image -->

                <div class="tag new"><span>new</span></div>
            </div>
            <!-- /.product-image -->

            <div class="product-info text-left">
                <h3 class="name"><a href="<?= $product->getPublicUrl() ?>">
                        <?= $product->title ?>
                    </a>
                </h3>
                <div class="rating rateit-small"></div>
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
                                </span></div>
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
                        <!--                                                                <li class="lnk wishlist"><a data-toggle="tooltip"-->
                        <!--                                                                                            class="add-to-cart"-->
                        <!--                                                                                            href="detail.html"-->
                        <!--                                                                                            title="Wishlist"> <i-->
                        <!--                                                                                class="icon fa fa-heart"></i> </a></li>-->
                        <!--                                                                <li class="lnk"><a data-toggle="tooltip" class="add-to-cart"-->
                        <!--                                                                                   href="detail.html" title="Compare"> <i-->
                        <!--                                                                                class="fa fa-signal" aria-hidden="true"></i>-->
                        <!--                                                                    </a></li>-->
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

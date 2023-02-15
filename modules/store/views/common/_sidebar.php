<?php

$categories = \app\models\Category::find()->orderBy('title')->all();

?>

<!-- ================================== TOP NAVIGATION ================================== -->
<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head"><i class="icon fa fa-align-justify fa-fw"></i>
        <?= Yii::t('public','Categories') ?>
    </div>
    <nav class="yamm megamenu-horizontal">
        <ul class="nav">
            <?php foreach ($categories as $category):?>
                <li class="menu-item">
                    <a href="<?= $category->getPublicUrl() ?>"><?= $category->title?></a>
                </li>
            <?php endforeach;?>
        </ul>
        <!-- /.nav -->
    </nav>
    <!-- /.megamenu-horizontal -->
</div>
<!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->


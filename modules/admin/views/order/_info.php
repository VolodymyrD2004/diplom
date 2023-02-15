<?php
/**
 * @var \app\models\Order $model
 *
 */
$cart = Yii::$app->cart;
$cart->setOrder($model);
?>

<table class="table table-responsive table-hover">
    <tbody>
    <tr>
        <th><?= Yii::t('app', 'Title')?></th>
        <th><?= Yii::t('app', 'Price')?></th>
        <th><?= Yii::t('app', 'Quantity')?></th>
        <th><?= Yii::t('app', 'Amount')?></th>
    </tr>
    <?php foreach ($model->orderItems as $orderItem): ?>
    <tr>
        <td>
            <?= $orderItem->product->title?>
        </td>
        <td>
            <?= Yii::$app->formatter->asCurrency($orderItem->price, 'UAH')?>
        </td>
        <td>
            <?= $orderItem->quantity?>
        </td>
        <td>
            <?= Yii::$app->formatter->asCurrency($orderItem->quantity * $orderItem->price, 'UAH')?>
        </td>
    </tr>
    <?php endforeach;?>
    <tr>
        <th colspan="3">
            <?= Yii::t('app', 'Total amount')?>
        </th>
        <th>
            <?= Yii::$app->formatter->asCurrency($cart->getTotalAmount(), 'UAH')?>
        </th>
    </tr>
    </tbody>
</table>

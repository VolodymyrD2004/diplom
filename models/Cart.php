<?php

namespace app\models;

use Yii;
use yii\base\Component;
use yii\base\Exception;
use yii\base\Model;
use yii\db\Expression;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;

/**
 * ContactForm is the model behind the contact form.
 */
class Cart extends Component
{

    /**
     * @var \app\models\Order
     */
    protected $order;

    /**
     * @throws \yii\base\Exception
     */
    public function setClient(string $clientSID)
    {
        $this->setOrder($this->getOrder($clientSID));
    }

    /**
     * @throws \yii\base\Exception
     */
    public function setOrder(Order $order)
    {
        $this->order = $order;
    }

    public function addProduct(int $productId, int $quantity = 1)
    {
        $product = Product::findOne($productId);
        if ( ! $product) {
            throw new NotFoundHttpException("Product not exist");
        }
        /**
         * @var $item OrderItem
         */
        $item = $this->order->getOrderItems()->andWhere(['product_id' => $productId])->limit(1)->one();
        if ( ! $item) {
            $item = new OrderItem(
                [
                    'order_id'   => $this->order->id,
                    'product_id' => $productId,
                    'price'      => $product->price,
                    'quantity'   => $quantity,
                ]
            );
        } else {
            $item->quantity++;
            $item->price = $product->price;
        }
        $item->save();
    }

    public function removeProduct(int $productId, bool $all = false)
    {
        $product = Product::findOne($productId);
        if ( ! $product) {
            throw new NotFoundHttpException("Product not exist");
        }
        /**
         * @var $item OrderItem
         */
        $item = $this->order->getOrderItems()->andWhere(['product_id' => $productId])->limit(1)->one();
        if ($item) {
            $item->quantity--;
            $item->price = $product->price;
        }
        if ($item->quantity <= 0 || $all) {
            $item->delete();
        } else {
            $item->save();
        }
    }

    public function getTotalAmount(): float
    {
        return $this->order->getOrderItems()->sum('price * quantity') ?? 0;
    }

    public function getItemsCount(): int
    {
        return count($this->order->orderItems);
    }

    /**
     * @return \app\models\OrderItem[]
     */
    public function getItems(): array
    {
        return $this->order->orderItems;
    }

    protected function getOrder(string $clientSID): Order
    {
        $order = Order::find()->andWhere(['client_sid' => $clientSID])->limit(1)->one();
        if ( ! $order) {
            $order = new Order(
                [
                    'client_sid' => $clientSID,
                    'status'     => Order::STATUS_NEW,
                    'created_at' => new Expression('NOW()'),
                ]
            );
        } else {
            $order->created_at = new  Expression('NOW()');
        }
        if ( ! $order->save()) {
            $order->validate();
            throw new Exception(Json::encode($order->errors));
        };

        return $order;
    }

    public function init()
    {
        parent::init();
    }
}

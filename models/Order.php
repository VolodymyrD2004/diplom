<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "order".
 *
 * @property int $id
 * @property string $phone
 * @property string|null $name
 * @property string $created_at
 * @property int $status
 *
 * @property OrderItem[] $orderItems
 * @property string      $client_sid [varchar(100)]
 */
class Order extends \yii\db\ActiveRecord
{
    const STATUS_NEW = 0;
    const STATUS_PAYED = 1;
    const STATUS_DONE = 100;

    public static function statusList(): array {
        return [
          self::STATUS_NEW => Yii::t('app', 'New order'),
          self::STATUS_PAYED => Yii::t('app', 'Payed order'),
          self::STATUS_DONE => Yii::t('app', 'Done order'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'order';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at'], 'safe'],
            [['status'], 'integer'],
            [['phone'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 500],
            [['client_sid'], 'required'],
            [['client_sid'], 'string', 'max' => 100],
            [['client_sid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'phone' => Yii::t('app', 'Phone'),
            'name' => Yii::t('app', 'Name'),
            'created_at' => Yii::t('app', 'Created At'),
            'status' => Yii::t('app', 'Status'),
            'client_sid' => Yii::t('app', 'Client SID'),
        ];
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::class, ['order_id' => 'id']);
    }
}

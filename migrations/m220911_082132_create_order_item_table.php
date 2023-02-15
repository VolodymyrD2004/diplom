<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order_item}}`.
 */
class m220911_082132_create_order_item_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%order_item}}',
            [
                'id'         => $this->primaryKey(),
                'order_id'   => $this->integer()->notNull(),
                'product_id' => $this->integer()->notNull(),
                'price'       => $this->decimal(10,5)->notNull(),
                'quantity'   => $this->integer()->notNull()->defaultValue(0),
            ],
            'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );

        $this->addForeignKey(
            'fk_order_item_order',
            '{{%order_item}}',
            'order_id',
            '{{%order}}',
            'id'
        );

        $this->addForeignKey(
            'fk_order_item_product',
            '{{%order_item}}',
            'product_id',
            '{{%product}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order_item}}');
    }
}

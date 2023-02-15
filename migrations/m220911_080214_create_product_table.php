<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m220911_080214_create_product_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%product}}',
            [
                'id'          => $this->primaryKey(),
                'sku'         => $this->string(20)->notNull()->unique(),
                'category_id' => $this->integer()->notNull(),
                'title'       => $this->string(254)->notNull(),
                'price'       => $this->decimal(10,5)->notNull(),
                'quantity'    => $this->integer()->notNull()->defaultValue(0),
                'show'        => $this->boolean()->defaultValue(false),
                'brand_title' => $this->string(200)->notNull(),
                'description' => $this->string(10000),
                'image'       => $this->string(400),
                'url'         => $this->string(254)->notNull()->unique(),
            ],
            'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );

        $this->addForeignKey(
            'fk_product_category',
            '{{%product}}',
            'category_id',
            '{{%category}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}

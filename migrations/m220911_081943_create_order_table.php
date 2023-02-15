<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%order}}`.
 */
class m220911_081943_create_order_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%order}}',
            [
                'id'         => $this->primaryKey(),
                'phone'      => $this->string(100),
                'name'       => $this->string(500),
                'created_at' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
                'status'     => $this->integer()->notNull()->defaultValue(0),
                'client_sid'     => $this->string(100)->notNull()->unique(),
            ],
            'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%order}}');
    }
}

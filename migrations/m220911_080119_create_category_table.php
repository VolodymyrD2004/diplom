<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%category}}`.
 */
class m220911_080119_create_category_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%category}}',
            [
                'id' => $this->primaryKey(),
                'title' => $this->string(254)->notNull()->unique(),
                'url' => $this->string(254)->notNull()->unique(),
                'image'       => $this->string(400),
            ],
            'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%category}}');
    }
}

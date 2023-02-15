<?php

use yii\db\Migration;
use yii\helpers\Console;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m220911_081700_create_user_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable(
            '{{%user}}',
            [
                'id'            => $this->primaryKey(),
                'login'         => $this->string(254)->unique()->notNull(),
                'email'         => $this->string(254)->unique()->notNull(),
                'role_id'       => $this->integer()->notNull()->defaultValue(1),
                'access_token'  => $this->string(1024)->notNull(),
                'access_key'    => $this->string(1024)->notNull(),
                'password_hash' => $this->string()->notNull(),
            ],
            'CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci'
        );


        $user = new \app\models\User(
            [
                'login'   => 'admin',
                'email'   => 'admin@app.name',
                'role_id' => \app\models\User::ROLE_ADMIN,
            ]
        );
        $user->setPassword('admin');

        $user->save(false)
            ?
            Console::output('admin created')
            :
            Console::output('admin NOT SAVED');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}

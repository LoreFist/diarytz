<?php

use yii\db\Migration;

/**
 * Class m200505_175618_user
 */
class m200505_175618_user extends Migration {
    /**
     * {@inheritdoc}
     */
    public function safeUp() {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('user', [
            'id'                   => $this->primaryKey(),
            'username'             => $this->string()->notNull()->unique(),
            'auth_key'             => $this->string(32)->notNull(),
            'password_hash'        => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email'                => $this->string()->notNull()->unique(),
            'created_at'           => $this->timestamp()->null()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at'           => $this->timestamp()->defaultValue(null)->append('ON UPDATE CURRENT_TIMESTAMP')
        ], $tableOptions);

        $this->createIndex(
            'in-email',
            'user',
            'email',
            true
        );

        $this->createIndex(
            'in-pass_hash',
            'user',
            'password_hash',
            true
        );

        $this->createIndex(
            'in-pass_reset_token',
            'user',
            'password_reset_token',
            true
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown() {
        $this->dropTable('user');
    }

}

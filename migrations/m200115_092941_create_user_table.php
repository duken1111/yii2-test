<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user}}`.
 */
class m200115_092941_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     * @return bool|void
     * @throws \yii\base\Exception
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->comment('Имя'),
            'auth_key' => $this->string(32)->null(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique()->comment('Email'),
            'created_at' => $this->integer()->null()->comment('Дата создания'),
            'updated_at' => $this->integer()->null()->comment('Дата изменения'),
        ], $tableOptions);

        $this->insert('{{%user}}', [
            'username' => 'Тестер',
            'email' => 'test@test.ru',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->security->generatePasswordHash('qwerty123'),
            'created_at' => strtotime('now'),
            'updated_at' => strtotime('now'),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }
}

<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%product}}`.
 */
class m200116_063307_create_product_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%product}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(150)->notNull()->comment('Наименования товара'),
            'description' => $this->string(1500)->null()->comment('Описание товара'),
            'production_date' => $this->date()->notNull()->comment('Дата изготовления товара'),
            'created_at' => $this->integer(11)->null()->comment('Дата создания'),
            'updated_at' => $this->integer(11)->null()->comment('Дата изменения'),
        ], $tableOptions);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%product}}');
    }
}

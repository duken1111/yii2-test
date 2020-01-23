<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%price}}`.
 */
class m200116_113224_create_price_table extends Migration
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

        $this->createTable('{{%price}}', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(11)->notNull()->comment('Товар'),
            'warehouse_id' => $this->integer(11)->notNull()->comment('Склад'),
            'price' => $this->decimal(10, 2)->null()->comment('Цена'),
            'quantity' => $this->integer(11)->null()->comment('Количество')
        ], $tableOptions);

        $this->createIndex('idx-unique-product-warehouse', '{{%price}}', ['product_id', 'warehouse_id'], true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex('idx-unique-product-warehouse','{{%price}}');
        $this->dropTable('{{%price}}');
    }
}

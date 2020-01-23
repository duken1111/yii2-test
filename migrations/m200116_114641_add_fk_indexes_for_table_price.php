<?php

use yii\db\Migration;

/**
 * Class m200116_114641_add_fk_indexes_for_table_price
 */
class m200116_114641_add_fk_indexes_for_table_price extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey('fk-price-product_id','{{%price}}', 'product_id','{{%product}}','id','CASCADE');
        $this->addForeignKey('fk-price-warehouse_id','{{%price}}', 'warehouse_id','{{%warehouse}}','id','CASCADE');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-price-product_id','{{%price}}');
        $this->dropForeignKey('fk-price-warehouse_id','{{%price}}');
        return true;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m200116_114641_add_fk_indexes_for_table_price cannot be reverted.\n";

        return false;
    }
    */
}

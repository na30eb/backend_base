<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%car}}`
 * - `{{%customer}}`
 */
class m240429_083933_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'car_id' => $this->integer()->notNull(),
            'customer_id' => $this->integer()->notNull(),
            'final_price' => $this->float(),
        ]);

        // creates index for column `car_id`
        $this->createIndex(
            '{{%idx-orders-car_id}}',
            '{{%orders}}',
            'car_id'
        );

        // add foreign key for table `{{%car}}`
        $this->addForeignKey(
            '{{%fk-orders-car_id}}',
            '{{%orders}}',
            'car_id',
            '{{%car}}',
            'id',
            'CASCADE'
        );

        // creates index for column `customer_id`
        $this->createIndex(
            '{{%idx-orders-customer_id}}',
            '{{%orders}}',
            'customer_id'
        );

        // add foreign key for table `{{%customer}}`
        $this->addForeignKey(
            '{{%fk-orders-customer_id}}',
            '{{%orders}}',
            'customer_id',
            '{{%customer}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%car}}`
        $this->dropForeignKey(
            '{{%fk-orders-car_id}}',
            '{{%orders}}'
        );

        // drops index for column `car_id`
        $this->dropIndex(
            '{{%idx-orders-car_id}}',
            '{{%orders}}'
        );

        // drops foreign key for table `{{%customer}}`
        $this->dropForeignKey(
            '{{%fk-orders-customer_id}}',
            '{{%orders}}'
        );

        // drops index for column `customer_id`
        $this->dropIndex(
            '{{%idx-orders-customer_id}}',
            '{{%orders}}'
        );

        $this->dropTable('{{%orders}}');
    }
}

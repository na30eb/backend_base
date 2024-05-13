<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%carDetails}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%car}}`
 */
class m240429_085102_create_carDetails_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%carDetails}}', [
            'id' => $this->primaryKey(),
            'id_car' => $this->integer()->notNull(),
            'inventory' => $this->integer(),
            'initialPrice' => $this->float(),
        ]);

        // creates index for column `id_car`
        $this->createIndex(
            '{{%idx-carDetails-id_car}}',
            '{{%carDetails}}',
            'id_car'
        );

        // add foreign key for table `{{%car}}`
        $this->addForeignKey(
            '{{%fk-carDetails-id_car}}',
            '{{%carDetails}}',
            'id_car',
            '{{%car}}',
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
            '{{%fk-carDetails-id_car}}',
            '{{%carDetails}}'
        );

        // drops index for column `id_car`
        $this->dropIndex(
            '{{%idx-carDetails-id_car}}',
            '{{%carDetails}}'
        );

        $this->dropTable('{{%carDetails}}');
    }
}

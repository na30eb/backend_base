<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%brands}}`
 * - `{{%models}}`
 */
class m240425_065636_create_car_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car}}', [
            'id' => $this->primaryKey(),
            'id_brand' => $this->integer()->notNull(),
            'id_model' => $this->integer()->notNull(),
            'color' => $this->string(),
            'speed' => $this->integer(),
            'consumption' => $this->integer(),
        ]);

        // creates index for column `id_brand`
        $this->createIndex(
            '{{%idx-car-id_brand}}',
            '{{%car}}',
            'id_brand'
        );

        // add foreign key for table `{{%brands}}`
        $this->addForeignKey(
            '{{%fk-car-id_brand}}',
            '{{%car}}',
            'id_brand',
            '{{%brands}}',
            'id_brand',
            'CASCADE'
        );

        // creates index for column `id_model`
        $this->createIndex(
            '{{%idx-car-id_model}}',
            '{{%car}}',
            'id_model'
        );

        // add foreign key for table `{{%models}}`
        $this->addForeignKey(
            '{{%fk-car-id_model}}',
            '{{%car}}',
            'id_model',
            '{{%models}}',
            'id_model',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%brands}}`
        $this->dropForeignKey(
            '{{%fk-car-id_brand}}',
            '{{%car}}'
        );

        // drops index for column `id_brand`
        $this->dropIndex(
            '{{%idx-car-id_brand}}',
            '{{%car}}'
        );

        // drops foreign key for table `{{%models}}`
        $this->dropForeignKey(
            '{{%fk-car-id_model}}',
            '{{%car}}'
        );

        // drops index for column `id_model`
        $this->dropIndex(
            '{{%idx-car-id_model}}',
            '{{%car}}'
        );

        $this->dropTable('{{%car}}');
    }
}

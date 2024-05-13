<?php

use yii\db\Migration;

/**
 * Class m240418_071559_brandsAndModels
 */
class m240418_071559_brandsAndModels extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('brands', [
            'id_brand' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
        $this->createTable('models', [
            'id_model' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_brand' => $this->integer()->notNull(), // Add foreign key column
        ]);
        $this->addForeignKey(
            'fk-models-brands', // Constraint name
            'models', // Child table
            'id_brand', // Child column
            'brands', // Parent table
            'id_brand', // Parent column
            'CASCADE', // ON DELETE option
            'CASCADE' // ON UPDATE option
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // Drop the foreign key constraint
        $this->dropForeignKey('fk-models-brands', 'models');

        // Drop the 'models' table
        $this->dropTable('models');

        // Drop the 'brands' table
        $this->dropTable('brands');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240418_071559_brandsAndModels cannot be reverted.\n";

        return false;
    }
    */
}

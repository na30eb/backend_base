<?php

use yii\db\Migration;

/**
 * Class m240416_124309_brands_migration
 */
class m240416_124309_brands_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        // Create the 'brands' table
        $this->createTable('brands', [
            'id_brand' =>  $this->integer() -> $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);

        // Create the 'models' table
        $this->createTable('models', [
            'id_model' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_brand' => $this->integer()->notNull(), // Add foreign key column
        ]);

        // Add foreign key constraint
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
        echo "m240416_124309_brands_migration cannot be reverted.\n";

        return false;
    }
    */
}

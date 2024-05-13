<?php

use yii\db\Migration;

/**
 * Class m240407_072300_first_migration
 */
class m240407_072300_first_migration extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()//add
    {
        $this->createTable('user',[
            'id'=>$this->primaryKey(),
            'username'=>$this->string(255),
            'status'=>$this->boolean(),
            'createdAt'=>$this->timestamp(),
            'email'=>$this->string()->notNull()
        ]);
        $this->insert('user',[
            'id'=>1,
            'username'=>"nastaran",
            'status'=>"admin",
            'createdAt' => date('Y-m-d H:i:s'),
            'email'=>"aaaaa@test.com",

        ]);
        $this->createTable('post',[
            'id'=>$this->primaryKey(),
            'tilte'=>$this->string(255),
            'user_id'=>$this->integer(),
        ]);
        $this->addForeignKey('fk_post_user','post','user_id','user','id');



    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()//drop or remove
    {

        $this->dropForeignKey('fk_post_user','post');
        $this->dropTable('post');
        $this->delete('user',[
            'id'=>1,
            'username'=>"nastaran",
            'status'=>"admin",
            'createdAt' => date('Y-m-d H:i:s'),
            'email'=>"aaaaa@test.com",

        ]);
        $this->dropTable('user');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m240407_072300_first_migration cannot be reverted.\n";

        return false;
    }
    */
}

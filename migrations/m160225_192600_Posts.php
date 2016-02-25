<?php

use yii\db\Migration;

class m160225_192600_Posts extends Migration
{
    public function up()
    {
        $this->createTable('posts',[
            'id'=>$this->primaryKey(),
            'title'=>$this->string('50')->notNull(),
            'text'=>$this->string('250')->notNull(),
            'text_preview'=>$this->string(100)->notNull(),
            'img'=>$this->string(250)->notNull()

        ]);

    }
    public function down()
    {
        $this->dropTable('posts');

    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}

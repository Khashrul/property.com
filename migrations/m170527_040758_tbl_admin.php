<?php

use yii\db\Migration;

class m170527_040758_tbl_admin extends Migration
{
    /*
    public function up()
    {

    }

    public function down()
    {
        echo "m170527_040758_tbl_admin cannot be reverted.\n";

        return false;
    }
    */
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'access_token' => $this->string()->notNull()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tbl_admin');
    }

}

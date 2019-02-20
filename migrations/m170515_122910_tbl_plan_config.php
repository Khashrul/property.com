<?php

use yii\db\Migration;

class m170515_122910_tbl_plan_config extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_plan_config', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'price' => $this->decimal()->notNull(),
            'duration' => $this->string()->notNull(),
            'details' => $this->text(),
            'status' => $this->integer(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),

        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tbl_plan_config');
    }
}

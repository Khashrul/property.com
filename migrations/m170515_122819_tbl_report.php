<?php

use yii\db\Migration;

class m170515_122819_tbl_report extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_report', [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'reason' => $this->text()->notNull(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),
        ]);

        // creates index for column `property_id`
        $this->createIndex(
            'idx-report-property_id',
            'tbl_report',
            'property_id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('tbl_report');
    }
}

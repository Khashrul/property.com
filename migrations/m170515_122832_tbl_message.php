<?php

use yii\db\Migration;

class m170515_122832_tbl_message extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_message', [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer()->notNull(),
            'sender_name' => $this->string(),
            'sender_email' => $this->string(),
            'sender_phone' => $this->string(),
            'receiver' => $this->integer(),
            'message' => $this->text(),
            'status' => $this->smallInteger(),
            'reply_of' => $this->integer(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),
        ]);

        // creates index for column `property_id`
        $this->createIndex(
            'idx-message-property_id',
            'tbl_message',
            'property_id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('tbl_message');
    }
}

<?php

use yii\db\Migration;

class m170515_122811_tbl_transaction extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_transaction', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'payment_method' => $this->integer()->notNull(),
            'payment_amount' => $this->decimal(),
            'payment_status' => $this->integer(),
            'order_id' => $this->string(),
            'transaction_id' => $this->string(),
            'saler_id' => $this->string(),
            'bank_receipt' => $this->string(),
            'transaction_datetime' => $this->dateTime(),
            'decline_reason' => $this->string(),
            'referral_id' => $this->string(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),

        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-transaction-user_id',
            'tbl_transaction',
            'user_id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('tbl_transaction');
    }
}

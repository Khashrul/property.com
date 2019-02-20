<?php

use yii\db\Migration;

class m170518_122840_tbl_user_subscription extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_user_subscription', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'plan_id' => $this->integer()->notNull(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),

        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-user-subscription-user_id',
            'tbl_user_subscription',
            'user_id'
        );

        // creates index for column `property_id`
        $this->createIndex(
            'idx-user-subscription-plan_id',
            'tbl_user_subscription',
            'plan_id'
        );

    }

    public function safeDown()
    {
        $this->dropTable('tbl_user_subscription');
    }
}

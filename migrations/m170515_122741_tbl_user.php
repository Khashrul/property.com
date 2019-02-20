<?php

use yii\db\Migration;

class m170515_122741_tbl_user extends Migration
{
    //    public function up()
//    {
//
//    }
//
//    public function down()
//    {
//        echo "m170515_105043_tbl_register cannot be reverted.\n";
//
//        return false;
//    }


    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_user', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'password' => $this->string()->notNull(),
            'phone' => $this->string()->notNull(),
            'address' => $this->string(),
            'photo' => $this->string(),
            'social_link' => $this->integer(),
            'user_type' => $this->integer(),
            'description' => $this->text(),
            'about_us' => $this->text(),
            'phone2' => $this->string(),
            'website_url' => $this->string(),
            'status' => $this->integer()->defaultValue(0),
            'oauth_token' => $this->string(),
            'referral_id' => $this->string(),
            'country' => $this->integer(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),

        ]);

        // creates index for column `social_link`
        $this->createIndex(
            'idx-user-social_link',
            'tbl_user',
            'social_link'
        );

    }

    public function safeDown()
    {
        $this->dropTable('tbl_user');
    }
}

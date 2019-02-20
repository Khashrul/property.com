<?php

use yii\db\Migration;

class m170608_054839_tbl_company extends Migration
{
//    public function up()
//    {
//
//    }
//
//    public function down()
//    {
//        echo "m170608_054839_tbl_company cannot be reverted.\n";
//
//        return false;
//    }

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_company', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'email' => $this->string()->notNull(),
            'location' => $this->string()->notNull(),
            'description' => $this->text(),
            'facebook_link' => $this->string(),
            'twitter_link' => $this->string(),
            'gmail_link' => $this->string(),
            'skype_link' => $this->string(),
            'phone1' => $this->string(),
            'phone2' => $this->string(),
            'logo' => $this->string(),
            'latitude' => $this->string()->notNull(),
            'longitude' => $this->string()->notNull(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),

        ]);

    }

    public function safeDown()
    {
        $this->dropTable('tbl_company');
    }
}

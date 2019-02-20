<?php

use yii\db\Migration;

class m170515_122842_tbl_social_links extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_social_links', [
            'id' => $this->primaryKey(),
            'facebook_url' => $this->string(),
            'google_url' => $this->string(),
            'twitter_url' => $this->string(),
            'skype_url' => $this->string(),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),

        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tbl_social_links');
    }
}

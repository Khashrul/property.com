<?php

use yii\db\Migration;

class m170619_110758_tbl_property_view extends Migration
{

    public function safeUp()
    {
        $this->createTable('tbl_property_view', [
            'id' => $this->primaryKey(),
            'property_id' => $this->integer(),
            'ip_address' => $this->string()->notNull(),
            'last_viewed' => $this->dateTime(),
            'view_count' => $this->integer()
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tbl_property_view');
    }

}

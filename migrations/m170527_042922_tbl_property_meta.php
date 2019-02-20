<?php

use yii\db\Migration;

class m170527_042922_tbl_property_meta extends Migration
{
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_property_meta', [
            'id' => $this->primaryKey(),
            'air_conditioning' => $this->integer()->null(),
            'internet' => $this->integer()->null(),
            'cable_tv' => $this->integer()->null(),
            'balcony' => $this->integer()->null(),
            'roof_terrace' => $this->integer()->null(),
            'terrace' => $this->integer()->null(),
            'lift' => $this->integer()->null(),
            'garage' => $this->integer()->null(),
            'security' => $this->integer()->null(),
            'high_standard' => $this->integer()->null(),
            'city_center' => $this->integer()->null(),
            'furniture' => $this->integer()->null(),
            'custom_option_1' => $this->integer()->null(),
            'custom_option_2' => $this->integer()->null(),
            'custom_option_3' => $this->integer()->null(),
            'custom_option_4' => $this->integer()->null(),
            'custom_option_5' => $this->integer()->null(),
            'custom_option_6' => $this->integer()->null(),
            'custom_option_7' => $this->integer()->null(),
            'custom_option_8' => $this->integer()->null(),
            'custom_option_9' => $this->integer()->null(),

        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tbl_property_meta');
    }
}

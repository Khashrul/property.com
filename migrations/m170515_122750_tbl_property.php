<?php

use yii\db\Migration;

class m170515_122750_tbl_property extends Migration
{

    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
        $this->createTable('tbl_property', [
            'id' => $this->primaryKey(),
            'property_type' => $this->integer(2)->comment('1=apartment,2=house,3=commercial,4=land'),
            'user_id' => $this->integer(),
            'location' => $this->string()->notNull(),
            'latitude' => $this->string()->notNull(),
            'longitude' => $this->string()->notNull(),
            'image' => $this->text(),
            'transaction_type' => $this->string(),
            'price' => $this->string(),
            'area' => $this->string(),
            'description' => $this->text(),
            'bedrooms' => $this->integer(),
            'bathrooms' => $this->integer(),
            'rooms' => $this->integer(),
            'commercial_type' => $this->string(),
            'land_type' => $this->string(),
            'region' => $this->string(),
            'city' => $this->integer(),
            'country' => $this->integer(),
            'meta_id' => $this->integer(),
            'is_featured' => $this->smallInteger(2)->notNull()->defaultValue(0)->comment('1=featured,0=not featured'),
            'create_datetime' => $this->dateTime(),
            'update_datetime' => $this->dateTime(),

        ]);
    }

    public function safeDown()
    {
        $this->dropTable('tbl_property');
    }
}

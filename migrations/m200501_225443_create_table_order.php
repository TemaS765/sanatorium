<?php

use yii\db\Migration;

/**
 * Class m200501_225443_create_table_order
 */
class m200501_225443_create_table_order extends Migration
{
	public function up()
	{
		$this->createTable(
			"order",
			[
				'id' => $this->primaryKey(11),
				'customer_id' => $this->integer(11)->notNull(),
				'housing_id' => $this->integer(11)->notNull(),
				'floor' => $this->string(255)->notNull(),
				'room' => $this->string(255)->notNull(),
				'room_type' => $this->string(255)->notNull(),
				'status' => $this->string(255)->notNull(),
				'arrival_date' => $this->dateTime()->notNull(),
				'departure_date' => $this->dateTime()->notNull(),
				'created_date' => $this->dateTime()->notNull()
			]
		);
	}
	
	public function down()
	{
		$this->dropTable('order');
	}
}

<?php

use yii\db\Migration;

/**
 * Class m200501_230004_create_table_housing
 */
class m200501_230004_create_table_housing extends Migration
{
	public function up()
	{
		$this->createTable(
			"housing",
			[
				'id' => $this->primaryKey(11),
				'name' => $this->char(1)->notNull(),
				'number_rooms' => $this->integer(3)->notNull()
			]
		);
	}
	
	public function down()
	{
		$this->dropTable('housing');
	}
}

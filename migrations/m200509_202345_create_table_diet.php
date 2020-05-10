<?php

use yii\db\Migration;

/**
 * Class m200509_202345_create_table_diet
 */
class m200509_202345_create_table_diet extends Migration
{
	public function up()
	{
		$this->createTable(
			'diet',
			[
				'id' => $this->primaryKey(11),
				'name' => $this->string(255)->notNull()
			]
		);
		
		for ($i = 1; $i <= 15; $i++) {
			$this->insert('diet', ['name' => $i]);
		}
	}
	
	public function down()
	{
		$this->dropTable('diet');
	}
}

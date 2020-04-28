<?php

use yii\db\Migration;

/**
 * Class m200428_182451_create_table_user
 */
class m200428_182451_create_table_user extends Migration
{
    public function up()
    {
		$this->createTable(
			"user",
			[
				'id' => $this->primaryKey(11),
				'username' => $this->string(255)->notNull(),
				'password' => $this->string(255)->notNull(),
				'role' => $this->string(255)->notNull()->defaultValue("user")
			]
		);
		$this->createIndex(
			"username_index",
			"user",
			"username",
			true
		);
    }

    public function down()
    {
        $this->dropTable("user");
    }
    
}

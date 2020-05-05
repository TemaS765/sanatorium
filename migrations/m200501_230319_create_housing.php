<?php

use yii\db\Migration;

/**
 * Class m200501_230319_create_housing
 */
class m200501_230319_create_housing extends Migration
{
    public function up()
    {
		$this->db->createCommand(
			'INSERT INTO housing (name, number_rooms) VALUES '.
			'(\'А\', 50),'.
			'(\'Б\', 50),'.
			'(\'В\', 50),'.
			'(\'Г\', 50),'.
			'(\'Д\', 50);'
		)->query();
    }

    public function down()
    {
        $this->truncateTable('housing');
    }
}

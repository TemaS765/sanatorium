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
			'(\'А\', 99),'.
			'(\'Б\', 99),'.
			'(\'В\', 99),'.
			'(\'Г\', 99),'.
			'(\'Д\', 99);'
		)->query();
    }

    public function down()
    {
        $this->truncateTable('housing');
    }
    
}

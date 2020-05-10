<?php

use yii\db\Migration;

/**
 * Class m200509_194922_create_table_treatment_schedule
 */
class m200509_194922_create_table_treatment_schedule extends Migration
{
    public function up()
    {
	    $this->createTable(
		    'treatment_schedule',
		    [
			    'id' => $this->primaryKey(11),
			    'customer_id' => $this->integer(11)->notNull(),
			    'treatment_ids' => $this->string()->notNull(),
			    'date' => $this->date()->notNull()
		    ]
	    );
    }

    public function down()
    {
    	$this->dropTable('treatment_schedule');
    }
}

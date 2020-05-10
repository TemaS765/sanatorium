<?php

use yii\db\Migration;

/**
 * Class m200509_194234_create_table_medical_card
 */
class m200509_194234_create_table_medical_card extends Migration
{
    public function up()
    {
	    $this->createTable(
		    'medical_card',
		    [
			    'id' => $this->primaryKey(11),
			    'customer_id' => $this->integer(11)->notNull(),
			    'treatment_ids' => $this->string()->notNull(),
			    'diet_id' => $this->integer(11)->notNull(),
			    'has_certificate_health' => 'ENUM(\'YES\', \'NO\') NOT NULL DEFAULT \'NO\''
		    ]
	    );
    }

    public function down()
    {
	    $this->dropTable('medical_card');
    }
}

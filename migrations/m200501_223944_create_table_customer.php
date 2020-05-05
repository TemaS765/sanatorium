<?php

use yii\db\Migration;

/**
 * Class m200501_223944_create_table_customer
 */
class m200501_223944_create_table_customer extends Migration
{
    
    public function up()
    {
	    $this->createTable(
		    "customer",
		    [
			    'id' => $this->primaryKey(11),
			    'full_name' => $this->string(255)->notNull(),
			    'phone' => $this->string(20)->notNull(),
			    'address' => $this->string(255)->notNull(),
			    'passport_data' => $this->string(255)->notNull(),
			    'birth_date' => $this->date()->notNull(),
			    'created_date' => $this->dateTime()->notNull()
		    ]
	    );
    }

    public function down()
    {
        $this->dropTable('customer');
    }
    
}

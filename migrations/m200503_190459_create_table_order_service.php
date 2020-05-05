<?php

use yii\db\Migration;

/**
 * Class m200503_190459_create_table_order_service
 */
class m200503_190459_create_table_order_service extends Migration
{
    public function up()
    {
	    $this->createTable(
		    "order_service",
		    [
			    'id' => $this->primaryKey(11),
			    'customer_id' => $this->integer(11)->notNull(),
			    'service_id' => $this->integer(11)->notNull(),
			    'executor' => $this->string(255)->notNull(),
			    'status' => 'ENUM(\'completed\', \'not_completed\') DEFAULT \'not_completed\' NOT NULL',
			    'completion_date' => $this->date()->notNull(),
			    'created_date' => $this->dateTime()->notNull()
		    ]
	    );
    }

    public function down()
    {
    	$this->dropTable('order_service');
    }
}

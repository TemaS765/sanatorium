<?php

use yii\db\Migration;

/**
 * Class m200503_185826_create_table_service
 */
class m200503_185826_create_table_service extends Migration
{
    public function up()
    {
	    $this->createTable(
		    "service",
		    [
			    'id' => $this->primaryKey(11),
			    'name' => $this->string(255)->notNull(),
			    'price' => $this->float(2)->notNull()
		    ]
	    );
	    $this->insert('service',[
	    	'name' => 'Индивидуальный трансфер',
		    'price' => 9520
	    ]);
	    $this->insert('service',[
		    'name' => 'Сувенирная продукция',
		    'price' => 540
	    ]);
    }

    public function down()
    {
    	$this->dropTable("service");
    }
}

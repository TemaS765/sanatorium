<?php

use yii\db\Migration;

/**
 * Class m200504_102837_create_table_housing_scheme
 */
class m200504_102837_create_table_housing_scheme extends Migration
{
    public function up()
    {
	    $this->createTable(
		    "housing_scheme",
		    [
			    'id' => $this->primaryKey(11),
			    'room' => $this->integer(11)->notNull(),
			    'room_type' => $this->integer(2)->notNull(),
			    'floor' => $this->integer(2)->notNull(),
			    'housing_id' => $this->integer(11)->notNull()
		    ]
	    );
	    
	    /** @var \app\models\Housing[] $housings */
	    $housings = \app\models\Housing::find()->all();
	    
	    foreach ($housings as $housing) {
	    	$floor = 1;
	    	for($i = 1; $i <= $housing->number_rooms; $i++) {
	    		/** Рандомно выставляем тип комнаты*/
	    		$room_type = random_int(1,4);
	    		
			    $this->insert(
				    'housing_scheme',
				    [
					    'room' => $i,
					    'room_type' => $room_type,
					    'floor' => $floor,
					    'housing_id' => $housing->id
				    ]
			    );
			    
			    if (($i % 10) == 0) {
				    $floor++;
			    }
		    }
	    }
    }

    public function down()
    {
    	$this->dropTable('housing_scheme');
    }
}

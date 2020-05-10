<?php

use yii\db\Migration;

/**
 * Class m200509_201808_create_table_treatment
 */
class m200509_201808_create_table_treatment extends Migration
{
    public function up()
    {
	    $this->createTable(
		    'treatment',
		    [
			    'id' => $this->primaryKey(11),
			    'name' => $this->string(255)->notNull()
		    ]
	    );
	    $this->insert('treatment', ['name' => 'Кислородный коктель']);
	    $this->insert('treatment', ['name' => 'Желудочно-кешечный сбор']);
	    $this->insert('treatment', ['name' => 'Желчегонный сбор']);
	    $this->insert('treatment', ['name' => 'Витаминный сбор']);
	    $this->insert('treatment', ['name' => 'Лечебная физкультура']);
	    $this->insert('treatment', ['name' => 'Жемчужная ванна']);
	    $this->insert('treatment', ['name' => 'Морская ванна']);
	    $this->insert('treatment', ['name' => 'Хвойная ванна']);
	    $this->insert('treatment', ['name' => 'Скипидарная ванна']);
	    $this->insert('treatment', ['name' => 'Гальваногрязь']);
	    $this->insert('treatment', ['name' => 'Массаж ручной']);
	    $this->insert('treatment', ['name' => 'Массаж механический']);
	    $this->insert('treatment', ['name' => 'Электросон']);
	    $this->insert('treatment', ['name' => 'УВИ']);
	    $this->insert('treatment', ['name' => 'Электрофорез']);
	    $this->insert('treatment', ['name' => 'Галокамера']);
	    $this->insert('treatment', ['name' => 'Ингаляция']);
	    $this->insert('treatment', ['name' => 'Аромотерапия']);
    }

    public function down()
    {
    	$this->dropTable('treatment');
    }
}

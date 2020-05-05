<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class HousingScheme Схема корпусов
 * @package app\models
 * @property int $id ID
 * @property int $room Номер комнаты
 * @property int $room_type Тип конаты
 * @property int $floor Этаж
 * @property int $housing_id ID корпуса
 * Связи
 * @property Housing $housing
 */
class HousingScheme  extends ActiveRecord
{
	public static function tableName()
	{
		return 'housing_scheme';
	}
	
	public function getHousing()
	{
		return $this->hasOne(Housing::class, ['id' => 'housing_id']);
	}
}
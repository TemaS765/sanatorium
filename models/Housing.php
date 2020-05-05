<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Housing Корпус
 * @package app\models
 * @property int $id ID корпуса
 * @property string $name Название корпуса
 * @property integer $number_rooms Количество комнат в корпусе
 * Связи
 * @property HousingScheme[] $scheme Схем корпуса
 */
class Housing extends ActiveRecord
{
	public static function tableName()
	{
		return 'housing';
	}
	
	public function getScheme()
	{
		return $this->hasMany(HousingScheme::class, ['housing_id' => 'id']);
	}
}

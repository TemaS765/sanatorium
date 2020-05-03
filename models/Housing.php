<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class Housing Корпус
 * @package app\models
 * @property int $id ID корпуса
 * @property string $name Название корпуса
 * @property integer $number_rooms Количество комнат в корпусе
 */
class Housing extends ActiveRecord
{
	public static function tableName()
	{
		return 'housing';
	}
}

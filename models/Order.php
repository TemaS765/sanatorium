<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class Order Заказ
 * @package app\models
 * @property int $id ID заказа
 * @property int $customer_id ID клиента
 * @property int $housing_id ID Корпуса
 * @property int $floor Этаж
 * @property int $room Комната
 * @property string $room_type Тип комнаты
 * @property string $status Статус заказа
 * @property string $arrival_date Дата прибытия
 * @property string $departure_date Дата убытия
 * @property string $created_date Дата создания заказа
 */
class Order extends ActiveRecord
{
	/**
	 * Статус отсутствует
	 */
	const STATUS_NONE = 'none';
	/**
	 * Статус размещен
	 */
	const STATUS_POSTED = 'posted';
	
	public static function tableName()
	{
		return 'order';
	}
	
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::class,
				'createdAtAttribute' => 'created_date',
				'updatedAtAttribute' => false,
				'value' => new Expression('NOW()'),
			],
		];
	}
}

<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;

/**
 * Class OrderService Заказы услуг
 * @package app\models
 * @property int $id
 * @property int $customer_id
 * @property int $service_id
 * @property string $executor
 * @property string $status
 * @property string $completion_date
 * @property string $created_date
 * Связи
 * @property Service $service
 */
class OrderService extends ActiveRecord
{
	/**
	 * Статуст выполнена
	 */
	const STATUS_COMPLETED = 'completed';
	/**
	 * Статус не выполнена
	 */
	const STATUS_NOT_COMPLETED = 'not_completed';
	
	public function getService()
	{
		return $this->hasOne(Service::class, ['id' => 'service_id']);
	}
	
	public function behaviors()
	{
		return [
			[
				'class' => TimestampBehavior::class,
				'createdAtAttribute' => 'created_date',
				'updatedAtAttribute' => false,
				'value' => new Expression('NOW()')
			],
		];
	}
}
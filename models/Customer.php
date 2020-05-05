<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\HttpException;

/**
 * Class Customer Клиент
 * @package app\models
 *
 * @property int $id ID клиента
 * @property string $full_name ФИО клиента
 * @property string phone Телефон клиента
 * @property string address Адрес клиента
 * @property string passport_data Паспортные данные
 * @property string birth_date Дата рождения
 * @property string created_date Дата создания клиента
 * Связи
 * @property Order $order Заказ клиента
 * @property OrderService[] $services Заказы услуг клиента
 */
class Customer extends ActiveRecord
{
	public static function tableName()
	{
		return 'customer';
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
	
	/**
	 * Получить заказ клиента
	 * @return \yii\db\ActiveQuery
	 */
	public function getOrder()
	{
		return $this->hasOne(Order::class, ['customer_id' => 'id']);
	}
	
	/**
	 * Получаем все заказы на дополнительные услуги
	 * @return \yii\db\ActiveQuery
	 */
	public function getServices()
	{
		return $this->hasMany(OrderService::class, ['customer_id' => 'id']);
	}
	
	public function delete()
	{
		if ($this->order->delete() === false) {
			throw new HttpException(400, "Не удалось удалить заказ клиента");
		}
		
		foreach ($this->services as $service) {
			if ($service->delete() === false) {
				throw new HttpException(400, "Не удалось удалить услуги предоставленные клиенту");
			}
		}
		
		return parent::delete();
	}
}

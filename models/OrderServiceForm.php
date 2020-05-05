<?php

namespace app\models;

use yii\base\Model;

/**
 * Class OrderServiceForm Форма создания заказа улуг
 * @package app\models
 */
class OrderServiceForm extends Model
{
	/**
	 * @var int ID услуги
	 */
	public $service;
	/**
	 * @var int ID клиента
	 */
	public $customer_id;
	/**
	 * @var string Дата выполнения услуги
	 */
	public $completion_date;
	/**
	 * @var string Исполнитель услуги
	 */
	public $executor;
	
	/**
	 * Правила валидации
	 * @return array
	 */
	public function rules()
	{
		return [
			[['service', 'completion_date', 'executor', 'customer_id'], 'required'],
			[['executor'], 'string', 'min' => 1, 'max' => 255],
			[['service', 'customer_id'], 'integer', 'integerOnly' => true],
			['service', 'exist', 'targetClass' => Service::class, 'targetAttribute' => ['service' => 'id'], 'message' => 'Услуга неизвестна'],
			['customer_id', 'exist', 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id'], 'message' => 'Клиент неизвестен'],
			[['completion_date'], 'date', 'format' => 'php:Y-m-d']
		];
	}
	
	/**
	 * Наименования для атрибутов
	 * @return array
	 */
	public function attributeLabels()
	{
		return [
			'service' => 'Услуга',
			'completion_date' => 'Дата выполнения',
			'executor' => 'Исполнитель'
		];
	}
	
	/**
	 * Доступные сценарии
	 * @return array
	 */
	public function scenarios()
	{
		return [
			'create' => [
				'service', 'completion_date', 'executor','customer_id'
			]
		];
	}
	
	/**
	 * Сохранить заказ на услугу
	 */
	public function save()
	{
		$orderService = new OrderService();
		$orderService->service_id = $this->service;
		$orderService->customer_id = $this->customer_id;
		$orderService->completion_date = $this->completion_date;
		$orderService->executor = $this->executor;
		
		return $orderService->save();
	}
}
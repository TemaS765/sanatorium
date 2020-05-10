<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class MedicalCard  Медицинская карта
 * @package app\models
 * @property int $id ID
 * @property int $customer_id ID клиента
 * @property string $treatment_ids IDs лечений
 * @property int $diet_id ID диеты
 * @property string $has_certificate_health Наличие справки
 * Связи
 * @property Treatment[] $treatments Лечения
 * @property Diet $diet Диета
 * @property Customer $customer Клиент
 */
class MedicalCard extends ActiveRecord
{
	/**
	 * @var Treatment[]
	 */
	public $treatments = [];
	/**
	 * Получаем клиента
	 * @return \yii\db\ActiveQuery
	 */
	public function getCustomer()
	{
		return $this->hasOne(Customer::class, ['id' => 'customer_id']);
	}
	
	/**
	 * Получаем диету
	 * @return \yii\db\ActiveQuery
	 */
	public function getDiet()
	{
		return $this->hasOne(Diet::class, ['id' => 'diet_id']);
	}
	
	/**
	 * Получаем лечения
	 * @return Treatment[]
	 */
	public function getTreatments()
	{
		if (empty($this->treatments)) {
			if (!empty($this->treatment_ids)) {
				$this->treatments = Treatment::find()->where('id IN ('.$this->treatment_ids.')')->all();
			}
		}
		
		return $this->treatments;
	}
}
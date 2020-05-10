<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class TreatmentSchedule График лечения
 * @package app\models
 * @property int $id ID диеты
 * @property int $customer_id ID клиента
 * @property int $treatment_ids IDs видов лечения
 * @property string $date Дата проведения процедур
 */
class TreatmentSchedule extends ActiveRecord
{
	/**
	 * Виды лечения
	 * @var Treatment[]
	 */
	public $treatments = [];
	
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
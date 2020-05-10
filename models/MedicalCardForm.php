<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * MedicalCardForm is the model behind the contact form.
 */
class MedicalCardForm extends Model
{
    public $card_id;
    public $diet_id;
    public $treatment_ids = [];
    public $has_certificate_health;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['card_id', 'diet_id', 'treatment_ids'], 'required'],
	        [['diet_id', 'card_id'], 'integer', 'integerOnly' => true],
	        [
	        	'card_id',
		        'exist',
		        'targetClass' => MedicalCard::class,
		        'targetAttribute' => [
		        	'card_id' => 'id'
		        ],
		        'message' => 'Медичинская карта не найдена'
	        ],
	        ['treatment_ids', 'validateTreatments']
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
	    return [
		    'treatment_ids' => 'IDs видов личения',
		    'diet_id' => 'ID диеты',
		    'card_id' => 'ID медицинской карты'
	    ];
    }
	
	/**
	 * Валидация для видов лечений
	 * @param string $attribute Валидируемый атрибут
	 * @param array $params Дополнительные параметры валидации
	 */
	public function validateTreatments($attribute, $params)
	{
		$treatment_ids = implode(',', $this->treatment_ids);
		$countRecord = (int) Treatment::find()->where('id IN ('.$treatment_ids.')')->count();
		$countSelected = count($this->treatment_ids);
		
		if ($countRecord != $countSelected) {
			$this->addError($attribute, "Выбраны недоступные виды личения");
		}
	}
	
	public function save()
	{
		$medicalCard = MedicalCard::findOne(['id' => $this->card_id]);
		$medicalCard->diet_id = $this->diet_id;
		$medicalCard->treatment_ids = implode(',', $this->treatment_ids);
		$medicalCard->has_certificate_health = $this->has_certificate_health;
		return $medicalCard->save();
	}
}

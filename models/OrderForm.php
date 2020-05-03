<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\i18n\Formatter;
use yii\validators\DateValidator;

/**
 * Class OrderForm Форма управления заказом
 * @package app\models
 */
class OrderForm extends Model
{
	/**
	 * @var string ФИО клиента
	 */
    public $full_name;
	/**
	 * @var string Паспортные данные
	 */
    public $passport_data;
	/**
	 * @var string Дата рождения клиента
	 */
    public $birth_date;
	/**
	 * @var integer Телефон клиента
	 */
    public $phone;
	/**
	 * @var string Адрес клиента
	 */
    public $address;
	/**
	 * @var int Корпус проживания
	 */
    public $housing;
	/**
	 * @var int Комната проживания
	 */
    public $room;
	/**
	 * @var string Дата прибытия
	 */
    public $arrival_date;
	/**
	 * @var string Даты выезда
	 */
    public $departure_date;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [
            	[
            		'full_name', 'passport_data', 'birth_date', 'phone', 'address', 'housing', 'room', 'arrival_date',
		            'departure_date'
	            ],
	            'required'
            ],
            [['full_name', 'passport_data','address'], 'string', 'min' => 1, 'max' => 255],
            [['phone', 'housing','room'], 'integer'],
            [['phone'], 'length' => 11],
            [['birth_date', 'arrival_date', 'departure_date'], 'date', 'format' => DateValidator::TYPE_DATE],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
	        'full_name' => 'ФИО',
	        'passport_data' => 'Паспортные данные',
	        'birth_date' => 'Дата рождения',
	        'phone' => 'Телефон',
	        'address' => 'Адрес',
	        'housing' => 'Корпус',
	        'room' => 'Комната',
	        'arrival_date' => 'Дата прибытия',
	        'departure_date' => 'Дата выезда'

        ];
    }
    
    public function save()
    {
    	$customer = new Customer();
        $customer->full_name = $this->full_name;
        $customer->passport_data = $this->passport_data;
        $customer->phone = $this->phone;
        $customer->address = $this->address;
	    $customer->birth_date = $this->birth_date;
	    
	    $housing = Housing::findOne(['id' => $this->housing]);
	    
	    $order = new Order();
    }
}

<?php

namespace app\models;

use yii\base\Model;
use yii\helpers\VarDumper;
use yii\web\HttpException;

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
	 * Правила валидации
	 * @return array
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
            [['housing','room'], 'integer', 'integerOnly' => true],
	        ['housing', 'exist', 'targetClass' => Housing::class, 'targetAttribute' => ['housing' => 'id'], 'message' => 'Корпус неизвестен'],
	        [['phone'], 'string'],
            [['phone'], 'filter', 'filter' => 'trim'],
	        ['phone', 'match', 'pattern' => '/^7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Телефона, должно быть в формате +7 (XXX) XXX-XX-XX'],
	        [['birth_date', 'arrival_date', 'departure_date'], 'date', 'format' => 'php:Y-m-d']
        ];
    }
	
	/**
	 * Наименования для атрибутов
	 * @return array
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
	
	/**
	 * Доступные сценарии
	 * @return array
	 */
    public function scenarios()
    {
	    return [
	    	'create' => [
	    		'full_name', 'passport_data', 'birth_date', 'phone', 'address', 'housing', 'room', 'arrival_date',
			    'departure_date'
		    ]
	    ];
    }
	
	/**
	 * Сохранение модели (Создание заказа)
	 * @throws HttpException
	 */
	public function save()
    {
    	$customer = new Customer();
        $customer->full_name = $this->full_name;
        $customer->passport_data = $this->passport_data;
        $customer->phone = $this->phone;
        $customer->address = $this->address;
	    $customer->birth_date = $this->birth_date;
	    
	    $housing = Housing::findOne(['id' => $this->housing]);
	    
	    if ($housing === null) {
		    throw new HttpException(400, "Не удалось загрузить корпус");
	    }
	    
	    $housingSchema = HousingScheme::findOne(['housing_id' => $housing->id, 'room' => $this->room]);
	    if ($housingSchema === null) {
		    throw new HttpException(400, "Не удалось загрузить схему размещения корпуса");
	    }
	
	    if (!$this->validateOrder()) {
		    throw new HttpException(400, "Не удалось создать заказ, все места в данной комнате заняты");
	    }
	
	    if (!$customer->save()) {
		    throw new HttpException(400, "Не удалось создать клиента");
	    }
	    
	    $order = new Order();
	    $order->customer_id = $customer->id;
	    $order->housing_id = $housing->id;
	    $order->floor = $housingSchema->floor;
	    $order->room = $this->room;
	    $order->room_type = $housingSchema->room_type;
	    $order->arrival_date = $this->arrival_date;
	    $order->departure_date = $this->departure_date;
	    
	    return $order->save();
    }
	
	/**
	 * Валидация заказа
	 * @return bool
	 */
    public function validateOrder()
    {
	    /** @var Order[] $orders */
	    $orders = Order::find()->where(
		    '(departure_date BETWEEN :date_from AND :date_to OR arrival_date BETWEEN :date_from AND :date_to) '.
		    'AND housing_id = :housing_id AND room = :room',
		    [
			    ':date_from' => $this->arrival_date,
			    ':date_to' => $this->departure_date,
			    ':housing_id' => $this->housing,
			    ':room' => $this->room
		    ]
	    )->all();
	    
	    /** @var HousingScheme $housingScheme */
	    $housingScheme = HousingScheme::findOne(
		    [
		    	'housing_id' => $this->housing,
			    'room' => $this->room
		    ]
	    );
	    
	    $allowedNumberBooking = (int) $housingScheme->room_type;
	    
	    return count($orders) < $allowedNumberBooking ? true : false;
    }
}

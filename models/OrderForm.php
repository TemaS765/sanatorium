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
	 * @var string Статус заказа
	 */
	public $status;
	/**
	 * @var string ID кастомера
	 */
	public $customer_id;
	
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
	            'required', 'on' => ['create']
            ],
            [['full_name', 'passport_data','address'], 'string', 'min' => 1, 'max' => 255, 'on' => ['create']],
            [['housing','room'], 'integer', 'integerOnly' => true, 'on' => ['create']],
	        ['housing', 'exist', 'targetClass' => Housing::class, 'targetAttribute' => ['housing' => 'id'], 'message' => 'Корпус неизвестен', 'on' => ['create']],
	        [['phone'], 'string', 'on' => ['create']],
            [['phone'], 'filter', 'filter' => 'trim', 'on' => ['create']],
	        ['phone', 'match', 'pattern' => '/^7\s\([0-9]{3}\)\s[0-9]{3}\-[0-9]{2}\-[0-9]{2}$/', 'message' => 'Телефона, должно быть в формате +7 (XXX) XXX-XX-XX', 'on' => ['create']],
	        [['birth_date', 'arrival_date', 'departure_date'], 'date', 'format' => 'php:Y-m-d', 'on' => ['create']],
	        [['status', 'customer_id'], 'required', 'on' => ['change_status']],
	        [['status'], 'string', 'on' => ['change_status']],
	        [['status'], 'in', 'range' => [Order::STATUS_NONE, Order::STATUS_POSTED], 'on' => ['change_status']],
	        [['customer_id'], 'integer', 'integerOnly' => true, 'on' => ['change_status']],
	        ['customer_id', 'exist', 'targetClass' => Customer::class, 'targetAttribute' => ['customer_id' => 'id'], 'message' => 'Клиент неизвестен', 'on' => ['change_status']]

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
	        'departure_date' => 'Дата выезда',
	        'status' => 'Статус заказа',
	        'customer_id' => 'ID клиента'
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
		    ],
		    'change_status' => [
			    'status', 'customer_id'
		    ]
	    ];
    }
	
	/**
	 * Сохранение модели (Создание заказа)
	 * @throws HttpException
	 */
	public function save()
    {
	    $order = new Order();
	
	    if ($this->getScenario() === 'create') {
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
		
		    $order->customer_id = $customer->id;
		    $order->housing_id = $housing->id;
		    $order->floor = $housingSchema->floor;
		    $order->room = $this->room;
		    $order->room_type = $housingSchema->room_type;
		    $order->arrival_date = $this->arrival_date;
		    $order->departure_date = $this->departure_date;
	    } elseif ($this->getScenario() === 'change_status') {
	        $order = Order::findOne(['customer_id' => $this->customer_id]);
	        $order->status = $this->status;
	    }
	    
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
		    '(departure_date >= :date_to and arrival_date < :date_to) OR '.
		    '(arrival_date >= :date_from and arrival_date <= :date_to) '.
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

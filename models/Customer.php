<?php

namespace app\models;

use yii\db\ActiveRecord;

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
 */
class Customer extends ActiveRecord
{
	public static function tableName()
	{
		return 'customer';
	}
}

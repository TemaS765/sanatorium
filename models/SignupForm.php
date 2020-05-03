<?php

namespace app\models;

use yii\base\Model;

/**
 * Class SignupForm Форма регистрации
 * @package app\models
 */
class SignupForm extends Model {
	
	public $username;
	public $password;
	
	public function rules() {
		return [
			[['username', 'password'], 'required', 'message' => 'Заполните поле'],
			['username', 'unique', 'targetClass' => User::className(),  'message' => 'Пользователь уже существует'],
		];
	}
	
	public function attributeLabels() {
		return [
			'username' => 'Пользователь',
			'password' => 'Пароль',
		];
	}
	
}
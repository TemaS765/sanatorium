<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Class User Пользователь системы
 * @package app\models
 * @property int $id
 * @property  string $username Имя пользователя
 * @property  string $password Пароль
 * @property  string $role Роль пользователя
 */
class User extends ActiveRecord implements \yii\web\IdentityInterface
{
	/**
	 *  Роли пользователя
	 */
	const roleAdmin = 'admin';
	const roleLeader = 'leader';
	const roleTherapist = 'therapist';
	const roleHealthWorker = 'health_worker';
	const roleCook = 'cook';
	
	/**
	 * @var array Наименование ролей пользователя
	 */
	public static $roles = [
		self::roleAdmin => 'Администратор',
		self::roleLeader => 'Вожатый',
		self::roleTherapist => 'Врач-терапевт',
		self::roleHealthWorker => 'Медицинский работник',
		self::roleCook => 'Повар'
	];
	
	public static function tableName()
	{
		return 'user';
	}
	
	/**
	 * @inheritDoc
	 */
	public static function findIdentity($id)
	{
		return static::findOne($id);
	}
	
	public static function findByUsername($username)
	{
		return static::findOne(['username' => $username]);
	}
	
	public function validatePassword($password)
	{
		return \Yii::$app->security->validatePassword($password, $this->password);
	}
	
	public function rules() {
		return [
			[['username', 'password'], 'required', 'message' => 'Заполните поле'],
			['username', 'unique', 'targetClass' => User::class,  'message' => 'Этот логин уже занят'],
		];
	}
	
	/**
	 * @inheritDoc
	 */
	public static function findIdentityByAccessToken($token, $type = null)
	{
		// TODO: Implement findIdentityByAccessToken() method.
	}
	
	/**
	 * @inheritDoc
	 */
	public function getId()
	{
		return $this->id;
	}
	
	/**
	 * @inheritDoc
	 */
	public function getAuthKey()
	{
		// TODO: Implement getAuthKey() method.
	}
	
	/**
	 * @inheritDoc
	 */
	public function validateAuthKey($authKey)
	{
		// TODO: Implement validateAuthKey() method.
	}
}

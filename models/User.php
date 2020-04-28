<?php

namespace app\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
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

<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Class LoginForm Форма авторизации
 * @package app\models
 */
class LoginForm extends Model
{
	/**
	 * @var string
	 */
    public $username;
	/**
	 * @var string
	 */
    public $password;
	/**
	 * @var bool
	 */
    public $rememberMe = true;
	/**
	 * @var null|User
	 */
    private $user = null;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['username', 'password'], 'required', 'message' => '{attribute} не может быть пустым'],
            ['password', 'validatePassword'],
        ];
    }
	
	public function attributeLabels() {
		return [
			'username' => 'Пользователь',
			'password' => 'Пароль',
		];
	}
	
	/**
     * Валидация пароля
     * @param string $attribute
     * @param array $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Неверный пароль');
            }
        }
    }

    /**
     * Авторизация пользователя
     * @return bool
     */
    public function login()
    {
        if ($this->validate()) {
	        return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->user === null) {
            $this->user = User::findByUsername($this->username);
        }

        return $this->user;
    }
	
	/**
	 * Получить список пользователей для вывода в поле select
	 * @return array
	 *         array['role'] Роль пользователя
	 *         array['username'] Имя пользователя
	 */
    public function getUserForSelect()
    {
    	$userList = [];
    	/** @var User[] $users */
    	$users = User::find()->all();
    	
    	foreach ($users as $user) {
		    $userList[$user->username] = $user->username;
	    }
	    return $userList;
    }
}

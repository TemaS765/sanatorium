<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
?>

<div class="index-body">
    <main class="index-main">
        <h1 class="index-title"><?= Html::encode($this->title) ?></h1>
	
	    <?php $form = ActiveForm::begin([
		    'id' => 'login-form',
		    'options' => [
			    'class' => 'authorization-form'
		    ],
	        'fieldConfig' => [
                'template' => "{label}\n{input}\n{error}",
                'options' => [
                    'tag' => 'div',
                    'class' => 'authorization-form__group'
                ],
	        ],
		    'method' => 'POST'
	    ]); ?>
	
	    <?= $form->field($model, 'username')->dropDownList([
		    'admin' => 'Администратор санатория',
		    'admin1' => 'Вожатый',
		    'admin2' => 'Врач-терапевт',
		    'admin3' => 'Медицинский работник',
		    'admin4' => 'Повар'
	    ],
		    [
			    'name' => 'login',
			    'id' => 'login',
		    ]
	    ) ?>
	    <?= $form->field(
	            $model,
                'password',
                [
                        'errorOptions' => ['class' => 'authorization-form__invalid']
                ]
        )->passwordInput(['class' => 'password-input']) ?>
	    <?= Html::submitButton('Вход', ['class' => 'login-btn']) ?>
	    <?php ActiveForm::end(); ?>
    </main>
</div>

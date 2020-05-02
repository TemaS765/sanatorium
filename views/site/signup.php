<?php
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Html;
$this->title = "Регистрация";
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
		
		<?= $form->field($model, 'username', ['errorOptions' => ['class' => 'authorization-form__invalid']])
            ->textInput([
			'id' => 'login',
			'class' => 'password-input',
			'autocomplete' => 'Off'
		])?>
		<?= $form->field(
			$model,
			'password',
			[
				'errorOptions' => ['class' => 'authorization-form__invalid']
			]
		)->passwordInput(['class' => 'password-input','autocomplete' => 'Off']) ?>
		<?= Html::submitButton('Создать пользователя', ['class' => 'login-btn']) ?>
		<?php ActiveForm::end(); ?>
    </main>
</div>

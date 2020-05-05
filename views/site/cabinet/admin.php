<?php
use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $housings \app\models\Housing[]
 * @var $customers \app\models\Customer[]
 * @var $scheduleBooking array
 * @var $services \app\models\Service[]
 */

 ?>
<header class="header">
	<div class="container header__container">
		<h1 class="header__name"><?= Html::encode(Yii::$app->user->identity->username) ?></h1>
		<nav class="nav">
			<span class="nav__item nav__item--active" id="nav-customers">Клиенты</span>
			<span class="nav__item" id="nav-reservation">Бронирование</span>
			<span class="nav__item" id="nav-reports">Отчёты</span>
		</nav>
		<a href="/site/logout" class="logout">Выход</a>
	</div>
</header>
<main class="main">
	<?= $this->render('admin/customers', ['customers' => $customers, 'services' => $services]); ?>
	<?= $this->render('admin/reservation', ['housings' => $housings, 'scheduleBooking' => $scheduleBooking]); ?>
	<?= $this->render('admin/reports',['customers' => $customers]); ?>
</main>




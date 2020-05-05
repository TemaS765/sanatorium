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
		</nav>
		<a href="/site/logout" class="logout">Выход</a>
	</div>
</header>
<main class="main">
	<section class="customers section section--active" id="section-1">
		<div class="container">
			<div class="customers__title">Клиенты</div>
			<div class="customers__table">
				<div class="customers__table-title">
					<div class="customers__name-title">ФИО</div>
					<div class="customers__house-room-title">Комната</div>
					<div class="customers__phone-title">В санатории</div>
					<div class="customers__accommodation-title">Размещён</div>
				</div>
				<?php foreach ($customers as $customer): ?>
                    <!-- Запись пользователя -->
                    <div class="customers__table-item">
                        <div class="customers__table-line">
                            
                            <!-- ФИО -->
                            <div class="customers__name"><?= Html::encode($customer->full_name) ?></div>
                            
                            <!-- Комната -->
                            <div class="customers__house-room"><?= Html::encode($customer->order->room) ?></div>
                            
                            <!-- В санатории -->
                            <div class="customers__data"><?= Html::encode($customer->order->arrival_date) ?></a></div>
                            
                            <!-- Размещён ли уже клиент, это отмечает вожатый -->
                            <form action="" name="OrderForm" class="accommodation-form">
                                <input type="checkbox" name="status"
                                       value="<?= $customer->order->status === \app\models\Order::STATUS_POSTED
                                           ? \app\models\Order::STATUS_NONE
                                           : \app\models\Order::STATUS_POSTED ?>"
                                       class="accommodation-form__checkbox"
                                       <?= $customer->order->status === \app\models\Order::STATUS_POSTED ? 'checked' : '' ?>
                                >
                                <button class="accommodation-form__submit">Подтвердить</button>
                                <input name="customer_id" value="<?= Html::encode($customer->id) ?>" type="hidden">
                            </form>
                        </div>
                        <!-- /.customers__table-line -->
                    </div>
                    <!-- /.customers__table-item -->
                <?php endforeach; ?>
			
			</div>
			<!-- /.customers__table -->
		
		</div>
		<!-- /.container -->
	</section>
	<!-- customers -->
</main>




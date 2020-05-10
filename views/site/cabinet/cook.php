<?php
use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $housings \app\models\Housing[]
 * @var $customers \app\models\Customer[]
 * @var $scheduleBooking array
 * @var $services \app\models\Service[]
 * @var $diets \app\models\Diet[]
 * @var $activeOrders \app\models\Order
 */

    $activeOrders = \app\models\Order::find()
        ->where('departure_date >= :date', [':date' => date('Y-m-d')])
	    ->all();

    $customerIds = array_map(
    	function ($order) {
    		/** @var \app\models\Order $order */
		    return $order->customer_id;
	    },
	    $activeOrders
    );
    $medicalCards = \app\models\MedicalCard::find()
        ->where('customer_id IN ('.implode(',', $customerIds).')')
        ->all();
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
    <section class="diet section section--active">
        <div class="container">
            <div class="title">Клиенты</div>
            <div class="diet__tabel">
                <div class="diet__line">
                    <span class="diet__line-title">Диета:</span>
                    <?php foreach ($diets as $diet): ?>
                        <span class="diet__line-title"><?= Html::encode($diet->name) ?></span>
                    <?php endforeach; ?>
                </div>
                <div class="diet__line">
                    <span class="diet__line-value">Кол-во питающихся:</span>
	                <?php foreach ($diets as $diet): ?>
                        <?php
                            $numberDiets = 0;
                            /** @var \app\models\MedicalCard $card */
		                    foreach ($medicalCards as $card) {
                                if ($card->diet_id == $diet->id) {
                                    $numberDiets++;
                                }
                            }
                        ?>
                        <span class="diet__line-value"><?= Html::encode($numberDiets) ?></span>
	                <?php endforeach; ?>
                </div>
            </div>
            <!-- /.diet__tabel -->
        </div>
        <!-- /.container -->

    </section>
    <!-- customers -->
</main>
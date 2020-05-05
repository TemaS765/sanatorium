<?php
/**
 * @var $this yii\web\View
 * @var $customers \app\models\Customer[]
 */
$lastYear = date('Y');
$customersLastYear = array_reduce(
        $customers,
        function ($count, $customer) use ($lastYear) {
            /** @var \app\models\Customer $customer */
	        if (date('Y', strtotime('-1 year', time($customer->created_date))) == $lastYear) {
                $count++;
            }
            return $count;
        },
        0
);
$customersForecast = $customersLastYear + 5;
$customersTotal = count($customers)

?>
<section class="reports section" id="section-3">
    <div class="container">
        <h2 class="reservation__title">Статистика</h2>
        <div class="statistics">
            <div class="statistics__line">
                Клиентов за всё время: <span class="statistics__value"><?= $customersTotal ?></span>
            </div>
            <!-- /.statistics__line -->
            <div class="statistics__line">
                Клиентов за последний год: <span class="statistics__value"><?= $customersLastYear ?></span>
            </div>
            <!-- /.statistics__line -->
            <div class="statistics__line">
                Прогноз клиентов на следующий год: <span class="statistics__value"><?= $customersForecast ?></span>
            </div>
            <!-- /.statistics__line -->
        </div>
        <!-- /.statistics -->
    </div>
    <!-- /.container -->
</section></section>
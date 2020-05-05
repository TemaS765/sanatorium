<?php

/**
 * @var $this yii\web\View
 * @var $housings \app\models\Housing[]
 * @var $customers \app\models\Customer[]
 * @var $scheduleBooking array
 * @var $services \app\models\Service[]
 */

use yii\helpers\Html;

$this->title = Yii::$app->name.' | '.Yii::$app->user->identity->username;
?>
<?= $this->render(
        'cabinet/admin',
        [
                'housings' => $housings,
                'customers' => $customers,
                'scheduleBooking' => $scheduleBooking,
                'services' => $services
        ]
) ?>
<div class="modal">
    <div class="modal__window">
        <div class="modal__message"></div>
    </div>
</div>


<?php

/**
 * @var $this yii\web\View
 * @var $housings \app\models\Housing[]
 * @var $customers \app\models\Customer[]
 * @var $scheduleBooking array
 * @var $services \app\models\Service[]
 * @var $medicalCards \app\models\MedicalCard[]
 * @var $treatments \app\models\Treatment[]
 * @var $diets \app\models\Diet[]
 */

$this->title = Yii::$app->name.' | '.Yii::$app->user->identity->username;
$role = Yii::$app->user->identity->role;
?>
<?= $this->render(
        'cabinet/'.$role,
        [
                'housings' => $housings,
                'customers' => $customers,
                'scheduleBooking' => $scheduleBooking,
                'services' => $services,
                'medicalCards' => $medicalCards,
	            'diets' => $diets,
	            'treatments' => $treatments
        ]
) ?>
<div class="modal">
    <div class="modal__window">
        <div class="modal__message"></div>
    </div>
</div>


<?php
use yii\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var \app\models\Housing[] $housings
 * @var array $scheduleBooking
 */

?>
<!-- Корпус -->
<?php foreach ($housings as $housing): ?>
    <div class="rooms__home">
        <div class="rooms__line">
            <span>Корпус <?= Html::encode($housing->name) ?></span>
            <div class="">
                <img src="/img/arrow.svg" alt="" class="rooms__more-btn">
            </div>
        </div>
        <!-- /.rooms__line -->
        <div class="rooms__more">
			<?php foreach ($scheduleBooking[$housing->id] as $room => $sh): ?>
                <div class="room">
                    <span class="room__number"><?= $room ?></span>
                    <div class="room__checks">
						<?php $reservedSeats = $sh['reserved_seats']; ?>
						<?php for($i = 0; $i < $sh['capacity_room']; $i++): ?>
							<?php if ($reservedSeats): ?>
                                <div class="room__check room__check--busy"></div>
								<?php $reservedSeats--; ?>
							<?php else: ?>
                                <div class="room__check"></div>
							<?php endif; ?>
						<?php endfor; ?>
                    </div>
                    <!-- /.room__checks -->
                </div>
                <!-- /.room -->
			<?php endforeach; ?>
        </div>
        <!-- /.rooms__more -->
    </div>
<?php endforeach; ?>
<!-- /.rooms__home -->
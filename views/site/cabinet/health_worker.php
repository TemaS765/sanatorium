<?php
use yii\helpers\Html;

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

 ?>
<header class="header">
	<div class="container header__container">
		<h1 class="header__name"><?= Html::encode(Yii::$app->user->identity->username) ?></h1>
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
                    <div class="customers__date-title">В санатории</div>
                    <div class="customers__treatment-title">Лечение</div>
                    <div class="customers__schedule-title">График лечения</div>
                </div>
                <?php foreach ($customers as $customer) : ?>
                    <!-- Запись пользователя -->
                    <div class="customers__table-item">
                        <div class="customers__table-line">
                            <!-- ФИО -->
                            <div class="customers__name"><?= Html::encode($customer->full_name) ?></div>

                            <!-- В санатории -->
                            <div class="customers__date">
                                <?= Html::encode(str_replace('-','.',$customer->order->arrival_date)) ?>
                                &nbsp;&mdash;&nbsp;
                                <?= Html::encode(str_replace('-','.',$customer->order->departure_date)) ?>
                            </div>

                            <!-- Лечение -->
                            <div class="customers__treatment">
                                <div class="customers__treatment-list">
                                    <?php foreach ($customer->getMedicalCard()->getTreatments() as $treatment) : ?>
                                        <span><?= Html::encode($treatment->name) ?></span>
                                    <?php endforeach; ?>
                                </div>
                                <!-- /.customers__treatment-list -->
                            </div>
                            <!-- График лечения -->
                            <div class="schedule customers__schedule">
                                <?php foreach ($customer->getTreatmentSchedules() as $treatmentSchedule) : ?>
                                    <div class="schedule__day">
                                        <div class="schedule__date"><?= Html::encode($treatmentSchedule->date) ?></div>
                                        <div class="schedule__treatment-list">
                                            <?php foreach ($treatmentSchedule->getTreatments() as $treatment) : ?>
                                                <span><?= Html::encode($treatment->name) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- /.schedule__day -->
                                <?php endforeach; ?>
                            </div>

                            <div class="customers__more">
                                <div class="customers__more-doc-edit">Изменить</div>
                            </div>
                        </div>
                        <!-- /.customers__table-line -->

                        <div class="customers__table-more">
                            <form action="" onsubmit="return false" method="POST" class="med-edit">
                                <?php foreach ($customer->getTreatmentSchedules() as $ts) : ?>
                                    <div class="med-edit__line">
                                        <div class="med-edit__date">
                                            <?= Html::encode($ts->date) ?>
                                        </div>
                                        <div class="med-edit__treatment-list">
                                            <?php foreach ($customer->getMedicalCard()->getTreatments() as $t) : ?>
                                                <div class="input-group">
                                                    <input type="checkbox" name="treatment_schedule[<?= $ts->id ?>][]"
                                                           class="doc-edit__treatment-input"
                                                           value="<?= $t->id ?>"
                                                           <?php if (in_array($t->id, explode(',', $ts->treatment_ids))) : ?>
                                                                checked
                                                            <?php endif; ?>
                                                    >
                                                    <label class="label-checkbox"><?= Html::encode($t->name) ?></label>
                                                </div>
                                                <!-- /.input-group -->
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                    <!-- /.med-edit__line -->
                                <?php endforeach; ?>

                                <div class="med-edit__submit">
                                    <button>Подтвердить</button>
                                </div>
                            </form>
                            <!-- /.doc-edit -->

                            <!-- /.customers__button-box -->
                        </div>
                        <!-- /.customers__table-more -->
                    </div>
                <?php endforeach; ?>
                <!-- /.customers__table-item -->
            </div>
            <!-- /.customers__table -->

        </div>
        <!-- /.container -->
    </section>
    <!-- customers -->
</main>
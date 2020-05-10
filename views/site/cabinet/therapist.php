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
                    <div class="customers__references-title">Наличие справок</div>
                    <div class="customers__diet-title">Диета</div>
                    <div class="customers__treatment-title">Лечение</div>
                </div>

                <?php foreach ($medicalCards as $medicalCard) : ?>
	                <!-- Запись пользователя -->
	                <div class="customers__table-item">
		                <div class="customers__table-line">
			                <!-- ФИО -->
			                <div class="customers__name">
				                <?= Html::encode($medicalCard->customer->full_name); ?>
			                </div>
			
			                <!-- Наличие справок -->
			                <div class="customers__references">
                                <?php if ($medicalCard->has_certificate_health === 'YES') : ?>
                                    <img src="/img/check.svg" alt="" style="width: 3rem;">
                                <?php else : ?>
                                    <img src="/img/uncheck.svg" alt="" style="width: 3rem;">
                                <?php endif; ?>
			                </div>
			
			                <!-- Диета -->
			                <div class="customers__diet">
                                <?= $medicalCard->diet ? Html::encode($medicalCard->diet->name) : '' ?>
                            </div>
			
			                <!-- Лечение -->
			                <div class="customers__treatment">
				                <div class="customers__treatment-list">
					                <?php foreach ($medicalCard->getTreatments() as $treatment) : ?>
                                        <span><?= Html::encode($treatment->name) ?></span>
                                    <?php endforeach; ?>
				                </div>
				                <!-- /.customers__treatment-list -->
			                </div>
			                <div class="customers__more">
				                <div class="customers__more-doc-edit">Изменить</div>
			                </div>
		                </div>
		                <!-- /.customers__table-line -->
		                <div class="customers__table-more">
			                <form action="" method="POST" class="doc-edit" id=form-"<?= $medicalCard->customer->id ?>">
				                <div class="doc-edit__diet">
                                  <span>
                                    <div class="doc-edit__list-title">Диета:</div>
                                      <?php foreach ($diets as $k => $diet) : ?>
                                          <div class="input-group">
                                              <input type="radio" name="diet_id"
                                                     id="diet-input-<?= $diet->id ?>-<?= $medicalCard->customer->id ?>"
                                                     class="doc-edit__diet-input" value="<?= $diet->id ?>"
                                                     <?php if ($diet->id == $medicalCard->diet_id) : ?>
                                                         checked
                                                     <?php endif; ?>
                                              >
                                              <label class="label-radio"
                                                     for="diet-input-<?= $diet->id ?>-<?= $medicalCard->customer->id ?>">
                                                  <?= Html::encode($diet->name) ?>
                                              </label>
                                          </div>
                                          <!-- /.input-group -->
                                      <?php endforeach; ?>
                                  </span>
                                </div>
                                <!-- /.doc-edit__diet -->
                                <div class="doc-edit__treatment">
                                  <span>
                                    <div class="doc-edit__list-title">Лечение:</div>
                                      <?php foreach ($treatments as $k => $treatment) : ?>
                                          <div class="input-group">
                                            <input type="checkbox" name="treatment_ids[]"
                                                   id="treatment-input-<?= $treatment->id ?>-<?= $medicalCard->customer->id ?>"
                                                   class="doc-edit__treatment-input" value="<?= $treatment->id ?>"
                                                   <?php if (in_array($treatment->id, explode(',', $medicalCard->treatment_ids))) : ?>
                                                    checked
                                                   <?php endif; ?>
                                            >
                                            <label class="label-checkbox"
                                                   for="treatment-input-<?= $treatment->id ?>-<?= $medicalCard->customer->id ?>">
                                                <?= Html::encode($treatment->name) ?>
                                            </label>
                                          </div>
                                          <!-- /.input-group -->
                                      <?php endforeach; ?>
                                  </span>
	                              <span>
		                              <div class="input-group input-group--references">
                                            <input type="checkbox" name="has_certificate_health" id="references"
                                                   class="doc-edit__treatment-input"
                                                   <?php if ($medicalCard->has_certificate_health == 'YES') : ?>
	                                                   checked
                                                   <?php endif; ?>
                                            >
                                            <label class="label-checkbox" for="references">Наличие справок</label>
                                     </div>
	                              </span>
                                </div>
                                <!-- /.doc-edit__treatment -->
                                <div class="doc-edit__button-box">
                                    <button class="">Подтвердить</button>
                                </div>
                                <input type="hidden" name="card_id" value="<?= $medicalCard->id ?>">
                             </form>
                        </div>
                        <!-- /.customers__table-more -->
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




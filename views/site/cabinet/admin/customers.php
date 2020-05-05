<?php

use yii\helpers\Html;
use app\models\Order;

/**
 * @var $this yii\web\View
 * @var $customers \app\models\Customer[]
 * @var $services \app\models\Service[]
 */
?>
<section class="customers section section--active" id="section-1">
    <div class="container">
        <div class="customers__title">Клиенты</div>
        <div class="customers__table">
            <div class="customers__table-title">
                <div class="customers__name-title">ФИО</div>
                <div class="customers__date-of-birth-title">Год рождения</div>
                <div class="customers__phone-title">Номер телефона</div>
                <div class="customers__accommodation-title">Размещён</div>
            </div>
            <?php foreach ($customers as $customer): ?>
                <!-- Запись пользователя -->
                <div class="customers__table-item">
                    <div class="customers__table-line">

                        <!-- ФИО -->
                        <div class="customers__name"><?= Html::encode($customer->full_name) ?></div>

                        <!-- Дата рождения -->
                        <div class="customers__date-of-birth"><?= Html::encode($customer->birth_date) ?></div>

                        <!-- Номер телефона -->
                        <div class="customers__phone">
                            <a href="tel:<?= Html::encode($customer->phone) ?>">
                                <?= Html::encode($customer->phone) ?>
                            </a>
                        </div>

                        <!-- Размещён ли уже клиент, это отмечает вожатый -->
                        <div class="customers__accommodation">
                            <?php $order = $customer->order; ?>
                            <?php if ($order->status === Order::STATUS_POSTED): ?>
                                <img src="/img/check.svg" alt=""  class="customers__accommodation-img">
                            <?php else: ?>
                                <img src="/img/uncheck.svg" alt=""  class="customers__accommodation-img">
                            <?php endif;?>
                        </div>

                        <div class="customers__more">
                            <img src="/img/arrow.svg" alt="" class="customers__more-arrow">
                        </div>

                    </div>
                    <!-- /.customers__table-line -->

                    <div class="customers__table-more">
                        <!-- Паспортные данные -->
                        <div class="customers__passport more-value">
                            <span>Паспортные данные: </span>
                            <div class="value"><?= Html::encode($customer->passport_data); ?></div>
                        </div>
                        <!-- Адресс -->
                        <div class="customers__address more-value">
                            <span>Адрес: </span>
                            <div class="value"><?= Html::encode($customer->address); ?></div>
                        </div>
                        <!-- С какого по какое находится в санатории -->
                        <div class="customers__data more-value">
                            <span>В санатории: </span>
                            <div class="value">
                               с <?= Html::encode($customer->order->arrival_date); ?>&nbsp;
                               по <?= Html::encode($customer->order->departure_date); ?>
                            </div>
                        </div>

                        <!-- Лечение, назначаемое врачём терапевтом -->
                        <div class="customers__treatment more-value">
                            <span>Лечение: </span><div class="value"><!-- Значение из БЗ --></div>
                        </div>

                        <!-- Наличие справок -->
                        <div class="customers__references more-value"><span>Наличие справок: </span>
                            <div class="value">
                                <!--
								  <img src="../assets/img/check.svg" alt="" style="width: 3rem;"> // если есть
								  <img src="../assets/img/uncheck.svg" alt="" style="width: 3rem;"> // если нет
								-->
                            </div>
                        </div>

                        <!-- Диета, назначаемая врачём терапевтом -->
                        <div class="customers__diet more-value">
                            <span>Диета: </span><div class="value"><!-- Значение из БЗ --></div>
                        </div>

                        <!-- График лечения, Выстраиваемый мед.работником -->
                        <div class="customers__schedule more-value">
                            <span>График лечения: </span><div class="value"><!-- Значение из БЗ --></div>
                        </div>

                        <div class="services">
                            <!-- Список уже добавленных услуг -->
                            <div class="services__list">
                                <?php foreach ( $customer->services as $order_service): ?>
                                    <div class="services__list-item">
                                        <span class=""><?= Html::encode($order_service->service->name) ?></span>
                                        <span class=""><?= Html::encode($order_service->completion_date) ?></span>
                                        <span class=""><?= Html::encode($order_service->service->price) ?></span>
                                        <button class="services__del" data-oid="<?= $order_service->id ?>">
                                            <img src="/img/del.svg" alt="Удалить">
                                        </button>
                                    </div>
                                    <!-- /.services__list-item -->
                                <?php endforeach; ?>
                            </div>
                            <!-- /.services__list -->

                            <form method="POST"  name="OrderServiceForm" class="services__form">
                                <div class="input-group">
                                    <select name="service" id="service"  class="services__input" required>
                                        <option value="" disabled selected hidden class="first-option">Выберите услугу</option>
                                        <?php foreach ($services as $service): ?>
                                            <option value="<?= $service->id ?>" data-price><?= Html::encode($service->name) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <span name="cost" class="services__cost"></span>
                                </div>
                                <!-- /.input-group -->
                                <div class="input-group">
                                    <input type="date" name="completion_date" id="serviceDate" class="services__input" required>
                                </div>
                                <!-- /.input-group -->
                                <div class="input-group">
                                    <input type="text" name="executor" id="executor" class="services__input" placeholder="Исполнитель" required>
                                </div>
                                <input type="text" name="customer_id" value="<?= $customer->id ?>" required hidden>
                                <!-- /.input-group -->
                                <button class="services__form-btn-submit">Добавить</button>
                            </form>

                        </div>
                        <!-- /.services -->

                        <div class="customers__button-box">
                            <button class="customers__button services-btn">Дополнительные услуги</button>
                            <a href="" class="customers__button">Путёвка</a>
                            <button class="customers__button del-btn -js-btn-del-customer"  data-cid="<?= $customer->id ?>">Удалить</button>
                        </div>
                        <!-- /.customers__button-box -->
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
<?php

use yii\helpers\Html;
use app\models\Housing;

/**
 * @var $housings Housing[] Корпуса
 * @var $scheduleBooking array
 */

?>
<section class="reservation section" id="section-2">
    <div class="container">
        <h2 class="reservation__title">Анкета гостя</h2>
        <form name="OrderForm" class="reservation__form">
            <div class="reservation__input-group input-group">
                <input type="text" name="full_name" class="reservation__input" autocomplete="off" placeholder="ФИО">
            </div>

            <div class="reservation__input-group input-group">
                <input type="text" name="passport_data" class="reservation__input" autocomplete="off" placeholder="Паспортные данные">
            </div>

            <div class="reservation__input-group">
                <label for="" class="reservation__label">Дата рождения:</label>
                <div class="input-group" style="margin: 0 2rem 0 auto;">
                    <input type="date" name="birth_date" class="reservation__input" autocomplete="off" placeholder="Дата рождения">
                </div>
            </div>

            <div class="reservation__input-group input-group" >
                <input type="tel" name="phone" class="reservation__input" autocomplete="off" placeholder="Номер телефона">
            </div>

            <div class="reservation__input-group input-group">
                <input type="text" name="address" class="reservation__input" autocomplete="off" placeholder="Адрес">
            </div>

            <div class="reservation__input-group">
                <div class="input-group">
                    <select name="housing" class="reservation__input">
                        <option selected disabled>Корпус</option>
                        <?php foreach ($housings as $housing): ?>
                            <option value="<?= $housing->id ?>"><?= $housing->name ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="input-group" style="margin: 0 2rem 0 auto;">
                    <input type="number" name="room" class="reservation__input" autocomplete="off" placeholder="Комната">
                </div>
            </div>

            <div class="reservation__input-group input-group">
                <label for="" class="reservation__label">С какого по какое:</label>
                <input type="date" name="arrival_date" class="reservation__input" autocomplete="off" placeholder="C">
                <input type="date" name="departure_date" class="reservation__input" autocomplete="off" placeholder="По">
            </div>

            <button class="reservation__button">Зарегистрировать</button>
        </form>
        <!-- /.reservation__form -->

        <h2 class="reservation__title">Комнаты</h2>
        <div class="rooms">
            <form action="" class="rooms__form">
                <span>С какого по какое:</span>
                <div class="input-group">
                    <input type="date" name="date_from" class="rooms__input">
                    <input type="date" name="date_to" class="rooms__input"></div>
                <button class="rooms__btn-submit">Узнать</button>
            </form>
            <!-- /.rooms__form -->
            <div class="-js-schedule-booking"></div>
        </div>
        <!-- /.rooms -->
    </div>
    <!-- /.container -->
</section>
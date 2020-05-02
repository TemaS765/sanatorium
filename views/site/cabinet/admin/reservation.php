<?php /* @var $this yii\web\View */ ?>
<section class="reservation none">
    <div class="container">
        <h2 class="reservation__title">Анкета гостя</h2>
        <form action="" class="reservation__form">
            <div class="reservation__input-group">
                <input type="text" name="full_name" class="reservation__input" autocomplete="off" placeholder="ФИО">
            </div>

            <div class="reservation__input-group">
                <input type="text" name="passport_data" class="reservation__input" autocomplete="off" placeholder="Паспортные данные">
            </div>

            <div class="reservation__input-group reservation__input-group--column">
                <label for="" class="reservation__label">Дата рождения:</label>
                <input type="date" name="birth_date" class="reservation__input" autocomplete="off" placeholder="Дата рождения">
            </div>

            <div class="reservation__input-group" >
                <input type="tel" name="phone" class="reservation__input" autocomplete="off" placeholder="Номер телефона">
            </div>

            <div class="reservation__input-group">
                <input type="text" name="address" class="reservation__input" autocomplete="off" placeholder="Адрес">
            </div>

            <div class="reservation__input-group">
                <input type="text" name="housing" class="reservation__input" autocomplete="off" placeholder="Корпус">
                <input type="text" name="room" class="reservation__input" autocomplete="off" placeholder="Комната">
            </div>

            <div class="reservation__input-group">
                <label for="" class="reservation__label">С какого по какое:</label>
                <input type="date" name="arrival_date" class="reservation__input" autocomplete="off" placeholder="C">
                <input type="date" name="departure_date" class="reservation__input" autocomplete="off" placeholder="По">
            </div>

            <button class="reservation__button">Зарегистрировать</button>
        </form>
        <!-- /.reservation__form -->
    </div>
    <!-- /.container -->
</section>
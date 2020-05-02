<?php /* @var $this yii\web\View */ ?>
<section class="customers">
    <div class="container">
        <div class="customers__title">Клиенты</div>
        <div class="customers__table">
            <div class="customers__table-title">
                <div class="customers__name-title">ФИО</div>
                <div class="customers__date-of-birth-title">Год рождения</div>
                <div class="customers__phone-title">Номер телефона</div>
                <div class="customers__accommodation-title">Размещён</div>
            </div>

            <!-- Запись пользователя -->
            <div class="customers__table-item">
                <div class="customers__table-line">

                    <!-- ФИО -->
                    <div class="customers__name"><!-- Значение из БЗ --></div>

                    <!-- Дата рождения -->
                    <div class="customers__date-of-birth"><!-- Значение из БЗ --></div>

                    <!-- Номер телефона -->
                    <div class="customers__phone"><a href="tel:<!-- Значение из БЗ -->"><!-- Значение из БЗ --></a></div>

                    <!-- Размещён ли уже клиент, это отмечает вожатый -->
                    <div class="customers__accommodation">
                        <!--
						  <img src="../assets/img/check.svg" alt=""  class="customers__accommodation-img> // если есть
						  <img src="../assets/img/uncheck.svg" alt=""  class="customers__accommodation-img> // если нет
						-->
                    </div>

                    <div class="customers__more">
                        <img src="/img/arrow.svg" alt="" class="customers__more-arrow">
                    </div>

                </div>
                <!-- /.customers__table-line -->

                <div class="customers__table-more">
                    <!-- Паспортные данные -->
                    <div class="customers__passport">
                        <span>Паспортные данные: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>
                    <!-- Адресс -->
                    <div class="customers__address">
                        <span>Адрес: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>
                    <!-- С какого по какое находится в санатории -->
                    <div class="data">
                        <span>В санатории: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>

                    <!-- Лечение, назначаемое врачём терапевтом -->
                    <div class="customers__treatment">
                        <span>Лечение: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>

                    <!-- Наличие справок -->
                    <div class="customers__references"><span>Наличие справок: </span>
                        <div class="value">
                            <!--
							  <img src="../assets/img/check.svg" alt="" style="width: 3rem;"> // если есть
							  <img src="../assets/img/uncheck.svg" alt="" style="width: 3rem;"> // если нет
							-->
                        </div>
                    </div>

                    <!-- Диета, назначаемая врачём терапевтом -->
                    <div class="customers__diet">
                        <span>Диета: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>

                    <!-- График лечения, Выстраиваемый мед.работником -->
                    <div class="customers__schedule">
                        <span>График лечения: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>

                </div>
                <!-- /.customers__table-more -->
            </div>
            <!-- /.customers__table-item -->

        </div>
        <!-- /.customers__table -->

    </div>
    <!-- /.container -->
</section>
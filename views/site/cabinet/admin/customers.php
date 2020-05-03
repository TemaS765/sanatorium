<?php /* @var $this yii\web\View */ ?>
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
                    <div class="customers__passport more-value">
                        <span>Паспортные данные: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>
                    <!-- Адресс -->
                    <div class="customers__address more-value">
                        <span>Адресс: </span><div class="value"><!-- Значение из БЗ --></div>
                    </div>
                    <!-- С какого по какое находится в санатории -->
                    <div class="customers__data more-value">
                        <span>В санатории: </span><div class="value"><!-- Значение из БЗ --></div>
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
                            <div class="services__list-item">
                                <span class=""><!-- Услуга --></span>
                                <span class=""><!-- Дата --></span>
                                <span class=""><!-- Стоимость --></span>
                                <button class="services__del">
                                    <img src="/img/del.svg" alt="Удалить">
                                </button>
                            </div>
                            <!-- /.services__list-item -->
                        </div>
                        <!-- /.services__list -->

                        <form method="POST" class="services__form">
                            <div class="input-group">
                                <select name="service" id="service"  class="services__input" required>
                                    <option value="" disabled selected hidden class="first-option">Выберите услугу</option>
                                    <option value="500">Индивидуальный трансфер</option>
                                    <option value="100">Сувенирная продукция</option>
                                </select>
                                <span name="cost" class="services__cost"></span>
                            </div>
                            <!-- /.input-group -->
                            <div class="input-group">
                                <input type="date" name="serviceDate" id="serviceDate" class="services__input" required>
                            </div>
                            <!-- /.input-group -->
                            <div class="input-group">
                                <input type="text" name="executor" id="executor" class="services__input" placeholder="Исполнитель" required>
                            </div>
                            <!-- /.input-group -->
                            <button class="services__form-btn-submit">Добавить</button>
                        </form>

                    </div>
                    <!-- /.services -->

                    <div class="customers__button-box">
                        <button class="customers__button services-btn">Дополнительные услуги</button>
                        <a href="" class="customers__button">Путёвка</a>
                        <button class="customers__button del-btn">Удалить</button>
                    </div>
                    <!-- /.customers__button-box -->
                </div>
                <!-- /.customers__table-more -->
            </div>
            <!-- /.customers__table-item -->
        </div>
        <!-- /.customers__table -->

    </div>
    <!-- /.container -->
</section>
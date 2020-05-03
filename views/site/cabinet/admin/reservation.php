<section class="reservation section" id="section-2">
    <div class="container">
        <h2 class="reservation__title">Анкета гостя</h2>
        <form action="" class="reservation__form">
            <div class="reservation__input-group input-group">
                <input type="text" name="name" class="reservation__input" autocomplete="off" placeholder="ФИО">
            </div>

            <div class="reservation__input-group input-group">
                <input type="text" name="passport" class="reservation__input" autocomplete="off" placeholder="Паспортные данные">
            </div>

            <div class="reservation__input-group">
                <label for="" class="reservation__label">Дата рождения:</label>
                <div class="input-group" style="margin: 0 2rem 0 auto;">
                    <input type="date" name="dateOfBirth" class="reservation__input" autocomplete="off" placeholder="Дата рождения">
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
                    <input type="text" name="house" class="reservation__input" autocomplete="off" placeholder="Корпус">
                </div>
                <div class="input-group" style="margin: 0 2rem 0 auto;">
                    <input type="number" name="room" class="reservation__input" autocomplete="off" placeholder="Комната">
                </div>
            </div>

            <div class="reservation__input-group input-group">
                <label for="" class="reservation__label">С какого по какое:</label>
                <input type="date" name="dateStart" class="reservation__input" autocomplete="off" placeholder="C">
                <input type="date" name="dateEnd" class="reservation__input" autocomplete="off" placeholder="По">
            </div>

            <button class="reservation__button">Зарегистрировать</button>
        </form>
        <!-- /.reservation__form -->

        <h2 class="reservation__title">Комнаты</h2>
        <div class="rooms">
            <form action="" class="rooms__form">
                <span>С какого по какое:</span>
                <div class="input-group">
                    <input type="date" name="roomsDateStart" class="rooms__input">
                    <input type="date" name="roomsDateEnd" class="rooms__input"></div>
                <button class="rooms__btn-submit">Узнать</button>
            </form>
            <!-- /.rooms__form -->

            <!-- Корпус -->
            <div class="rooms__home">
                <div class="rooms__line">
                    <span>Корпус <!-- Буква корпуса А-Д --></span>
                    <div class="">
                        <img src="/img/arrow.svg" alt="" class="rooms__more-btn">
                    </div>
                </div>
                <!-- /.rooms__line -->
                <div class="rooms__more">

                    <div class="room">
                        <span class="room__number">1<!-- Номер комнаты --></span>
                        <div class="room__checks">
                            <div class="room__check room__check--busy"></div><!-- Место в комнате, если место занято то класс лист "room__check room__check--busy" -->
                            <div class="room__check"></div>
                            <div class="room__check"></div>
                            <div class="room__check"></div>
                        </div>
                        <!-- /.room__checks -->
                    </div>
                    <!-- /.room -->

                </div>
                <!-- /.rooms__more -->

            </div>
            <!-- /.rooms__home -->

        </div>
        <!-- /.rooms -->
    </div>
    <!-- /.container -->
</section>
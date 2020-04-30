<!-- <?php
$connect = mysqli_connect('127.0.0.1', 'maxim174_maxim', 'maxi7270218', 'maxim174_saulik');

if (!$connect) {
    die('Error connect to DataBase' . mysqli_error_list($connect));
}

$sql = "SELECT * FROM `customers`";
$result = $connect->query($sql); 


   
session_start();
if (!$_SESSION['admin']) {
    header('Location: /Saulik/');
}
?> -->

<!doctype html>
<html lang="ru">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Саулык | Администратор санатория</title>
  <link rel="shortcut icon" href="../assets/img/logo.svg" type="image/png">

  <!-- Шрифт Rubik -->
  <!-- font-family: 'Rubik', sans-serif; -->
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;700&display=swap" rel="stylesheet">

  <!-- animate.css -->
  <!-- Библиотека с анимациями -->
  <link rel="stylesheet" href="../assets/css/animate.css">

  <!-- style.css -->
  <!-- Основной CSS файл-->
  <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
  <header class="header">
    <div class="container header__container">
      <h1 class="header__name">Администратор санатория</h1>
      <nav class="nav">
        <span class="nav__item nav__item--active" id="nav-1">Клиенты</span>
        <span class="nav__item" id="nav-2">Бронирование</span>
        <span class="nav__item" id="nav-3">Отчёты</span>
      </nav>
      <a href="../vendor/logout.php" class="logout">Выход</a>
    </div>
    <!-- /.container -->
  </header>

  <main class="main">
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
                <img src="../assets/img/arrow.svg" alt="" class="customers__more-arrow">
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
                <span>Адресс: </span><div class="value"><!-- Значение из БЗ --></div>
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
    <!-- customers -->

    <section class="reservation section" id="section-2">
      <div class="container">
        <h2 class="reservation__title">Анкета гостя</h2>
        <form action="" class="reservation__form">
          <div class="reservation__input-group">
            <input type="text" name="fullName" class="reservation__input" autocomplete="off" placeholder="ФИО">
          </div>
          
          <div class="reservation__input-group">
            <input type="text" name="passport" class="reservation__input" autocomplete="off" placeholder="Паспортные данные">
          </div>

          <div class="reservation__input-group reservation__input-group--column">
            <label for="" class="reservation__label">Дата рождения:</label>
            <input type="date" name="dateOfBirth" class="reservation__input" autocomplete="off" placeholder="Дата рождения">
          </div>

          <div class="reservation__input-group" >
            <input type="tel" name="phone" class="reservation__input" autocomplete="off" placeholder="Номер телефона">
          </div>

          <div class="reservation__input-group">
            <input type="text" name="address" class="reservation__input" autocomplete="off" placeholder="Адрес">
          </div>

          <div class="reservation__input-group">
            <input type="text" name="home" class="reservation__input" autocomplete="off" placeholder="Корпус">
            <input type="text" name="room" class="reservation__input" autocomplete="off" placeholder="Комната">
          </div>

          <div class="reservation__input-group">
            <label for="" class="reservation__label">С какого по какое:</label>
            <input type="date" name="dataStart" class="reservation__input" autocomplete="off" placeholder="C">
            <input type="date" name="dataEnd" class="reservation__input" autocomplete="off" placeholder="По">
          </div>
          
          <button class="reservation__button">Зарегистрировать</button>
        </form>
        <!-- /.reservation__form -->
      </div>
      <!-- /.container -->
    </section>
    <section class="reports section" id="section-3">
      отчёты
    </section>
  </main>

  <!-- jQuery -->
  <script src="../assets/js/jquery-3.4.1.min.js"></script>
  <!-- WOW -->
  <script src="../assets/js/wow.min.js"></script>
  <!-- jquery.validate -->
  <script src="../assets/js/jquery.validate.min.js"></script>
  <!-- jquery.mask autocomplete="off" -->
  <script src="../assets/js/jquery.mask.min.js"></script>
  <!-- main.js -->
  <script src="../assets/js/main.js"></script>
</body>

</html>
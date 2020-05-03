$(document).ready(function () {
  // Инициализация библиотеки WOW
  new WOW().init();
  // Маска для номера телефона
  $('[type=tel]').mask('+7 (000) 000-00-00');
  // Авторизация
  /*$('.login-btn').click(function (e) {
    e.preventDefault();

    $(`input`).removeClass('error');

    let login = $('select[name="login"]').val(),
      password = $('input[name="password"]').val();


    let validPass = false;
    ['pass1', 'pass2', 'pass3', 'pass4', 'pass5'].forEach(element => {
      ['Администратор санатория', 'Вожатый', 'Врач-терапевт', 'Медицинский работник', 'Повар'].forEach(elem => {
        if (login == elem && password == element) {
          validPass = true;
        }
      })
    })


    if (validPass) {
      $('.index-main').addClass('animated');
      $('.index-main').addClass('fadeOut');

      setTimeout(() => {
        $.ajax({
          url: 'vendor/signin.php',
          type: 'POST',
          dataType: 'json',
          data: {
            login: login,
            password: password
          },
          success(data) {
            console.log('data: ', data);
            if (data.status == 'admin') {
              document.location.href = '/Saulik/profile/admin.php';
            } else if (data.status == 'counselor') {
              document.location.href = '/Saulik/profile/counselor.php';
            } else if (data.status == 'doctor') {
              document.location.href = '/Saulik/profile/doctor.php';
            } else if (data.status == 'medicalWorker') {
              document.location.href = '/Saulik/profile/medicalWorker.php';
            } else if (data.status == 'cook') {
              document.location.href = '/Saulik/profile/cook.php';
            } else {

            }

          }
        });
      }, 800);

    } else {
      $('.password-input').addClass('password-input--invalid');
      $('.authorization-form__invalid').removeClass('none');
    }

  });*/

  // Навигация в header

  // При нажатии на любой элемент с классом 'nav__item'
  $('.nav__item').on('click', event => {
    let navItems = $('.nav__item');

    /*
     * У всех елементов убираем класс отвечающий за внешний вид активного элемента.
     * Даём данный класс именно тому элементу на, который нажал пользователь
     */ 
    navItems.removeClass('nav__item--active');
    event.currentTarget.classList.add('nav__item--active');
    /*
     * Всё так же с начало забираем класс активного элемента,
     * потом даём определённому элементу исходя и события клика
     */
    $('.section').removeClass('section--active');
    let i = 0;
    while(i < navItems.length){
      if (navItems[i] == event.target) {
        $('#section-' + (i + 1)).addClass('section--active');
      }
      i++;
    }  
  })


  // Список клиентов
  $('.customers__table-item').on('click', (e) => {
    if (e.target.className == 'customers__more-arrow' || e.target.className == 'customers__more-arrow customers__more-arrow--active') {
      e.target.classList.toggle('customers__more-arrow--active');
      e.delegateTarget.children['1'].classList.toggle('customers__table-more--active'); 
    }
  })

  // Дополнительные услуги
  $('.customers__table-more').on('click', (e) => {
    if (e.target.className == 'сustomers__button services-btn' || e.target.className == 'customers__button services-btn') {
      e.delegateTarget.children['7'].classList.toggle('services--active'); 
    }
  })

  // Таблица с комнатоми
  $('.rooms__home').on('click', (e) => {
    if (e.target.className == 'rooms__more-btn' || e.target.className == 'rooms__more-btn rooms__more-btn--active') {    
      e.target.classList.toggle('rooms__more-btn--active');
      e.delegateTarget.children['1'].classList.toggle('rooms__more--active'); 
    }
  })

});
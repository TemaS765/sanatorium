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
  $('#nav-customers').on('click', () => {
    $('#nav-customers').addClass('nav__item--active');
    $('#nav-reservation').removeClass('nav__item--active');
    $('#nav-reports').removeClass('nav__item--active');

    $('.customers').removeClass('none');
    $('.reservation').addClass('none');
    $('.reports').addClass('none');
  })

  $('#nav-reservation').on('click', () => {
    $('#nav-reservation').addClass('nav__item--active');
    $('#nav-customers').removeClass('nav__item--active');
    $('#nav-reports').removeClass('nav__item--active');

    $('.reservation').removeClass('none');
    $('.customers').addClass('none');
    $('.reports').addClass('none');
  })

  $('#nav-reports').on('click', () => {
    $('#nav-reports').addClass('nav__item--active');
    $('#nav-reservation').removeClass('nav__item--active');
    $('#nav-customers').removeClass('nav__item--active');

    $('.reports').removeClass('none');
    $('.reservation').addClass('none');
    $('.customers').addClass('none');
  })

  /*
   * Список клиентов 
   */
  $('.customers__table-item').on('click', (e) => {
    if (e.target.className == 'customers__more-arrow' || e.target.className == 'customers__more-arrow customers__more-arrow--active') {
      e.target.classList.toggle('customers__more-arrow--active');
      e.delegateTarget.children['1'].classList.toggle('customers__table-more--active'); 
    }
  })

  
});
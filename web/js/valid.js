/**
 * Функция сериализации формы
 * @param form Форма (DOM элемент)
 * @return Сериализованные данные
 */
var serializeForm = function (form) {
  var formName = form.getAttribute('name'),
      data = '';

  for(var i = 0; i < form.length; i++) {
    if (form[i].name) {
      data += data
          ? '&'+formName+'['+form[i].name+']='+form[i].value
          : formName+'['+form[i].name+']='+form[i].value;
    }
  }

  return encodeURI(data);
};

$(document).ready(function () {
  // Функции вывода и закрытия модального окна
  function modal (massage) {
    $('.modal').addClass('modal--active');
    $('.modal__message')[0].innerHTML = massage;
  }

  // Вункция закрытия модального окна нажатием на крестик или на поле вокруг модального окна
  $('.modal').on('click', () => {
    $('.modal').removeClass('modal--active');
  });

  window.addEventListener("keydown", function(event){
    if (event.keyCode == 27) {
      $('.modal').removeClass('modal--active');
    }
  }, true);
  
  // Добавление регулярных выражения 
  $.validator.addMethod(
    "regex",
    function(value, element, regexp) {
        var re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    },
    "Please check your input."
  );

  // Валидайия форм со страницы админа

  // Добовление дополнительных услуг
  $('.services__form').each(function () {
    $(this).validate({
      rules: {
        service: {
          required: true,
        },
        customer_id: {
          required: true,
        },
        completion_date: {
          required: true,
        },
        executor: {
          required: true,
        },
      },
      errorClass: "invalid",
      messages: {
        service: {
          required: "Выберите усугу",
        },
        completion_date:{
          required: "Выберите дату исполнения",
        },
        executor:{
          required: "Напишите исполнителя",
        },
      },
      submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "/order-service/create",
          data: serializeForm(form),

          // Ошибка отправки запроса
          error: (response) => {
            if (response.responseJSON !== undefined && response.responseJSON.status === 400) {
              modal(response.responseJSON.message);
            } else {
              modal("Ошибка запроса, попробуйте перезагрузить страницу");
            }
          },

          success: function (response) {
            if (response["status"] == "OK") {
              modal("Выполнено успешно");
              $(form)[0].reset();
            }
          }
        });
      }
    });
  });

  $('.services__del').on('click', (e) => {
    var $el = $(e.currentTarget),
        orderId = $el.data('oid');

    $.ajax({
      type: "POST",
      url: "/order-service/delete",
      data: 'id='+orderId,

      // Ошибка отправки запроса
      error: (response) => {
        if (response.responseJSON !== undefined && response.responseJSON.status === 400) {
          modal(response.responseJSON.message);
        } else {
          modal("Ошибка запроса, попробуйте перезагрузить страницу");
        }
      },

      success: function (response) {
        if (response["status"] == "OK") {
          modal("Выполнено успешно");
          //$el.closest('.services__list-item').remove();
        }
      }
    });
  });

  // Регистрация клиентов
  $('.reservation__form').validate({
    rules: {
      full_name: {
        required: true,
      },
      passport_data: {
        required: true,
      },
      birth_date: {
        required: true,
      },
      phone: {
        required: true,
      },
      address: {
        required: true,
      },
      housing: {
        required: true,
      },
      room: {
        required: true,
        range: [1, 50]
      },
      arrival_date: {
        required: true,
      },
      departure_date: {
        required: true,
      },
    },
    errorClass: "invalid",
    messages: {
      full_name: {
        required: "Заполните ФИО",
      },
      passport_data: {
        required: "Заполните паспортные данные",
      },
      birth_date: {
        required: "Заполните день рождения",
      },
      phone: {
        required: "Заполните номер телефона",
      },
      address: {
        required: "Заполните адрес",
      },
      housing: {
        required: "Заполните корпус",
      },
      room: {
        required: "Заполните комнату",
        range: "Номер комнаты (1-50)"
      },
      arrival_date: {
        required: "Заполните дату прибывания в санатории",
      },
      departure_date: {
        required: "Заполните дату выезда из санатория",
      },
    },
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "/order/create",
        data: serializeForm(form),

        // Ошибка отправки запроса
        error: (response) => {
          if (response.responseJSON !== undefined && response.responseJSON.status === 400) {
            modal(response.responseJSON.message);
          } else {
            modal("Ошибка запроса, попробуйте перезагрузить страницу");
          }
        },

        success: function (response) {
          if (response.status == "OK") {
            modal("Выполнено успешно");
            $(form)[0].reset();
          }
        }
      });
    }
  });

  //Удаление клиента
  $('.-js-btn-del-customer').on('click', (e) => {
    var $el = $(e.currentTarget),
        id = $el.data('cid');

    $.ajax({
      type: "POST",
      url: "/customer/delete",
      data: 'id='+id,

      // Ошибка отправки запроса
      error: (response) => {
        if (response.responseJSON !== undefined && response.responseJSON.status === 400) {
          modal(response.responseJSON.message);
        } else {
          modal("Ошибка запроса, попробуйте перезагрузить страницу");
        }
      },

      success: function (response) {
        if (response["status"] == "OK") {
          modal("Выполнено успешно");
        }
      }
    });
  });

  // Форма поиска свободных комнат 
  $('.rooms__form').validate({
    rules: {
      date_from: {
        required: true,
      },
      date_to: {
        required: true,
      },
    },
    errorClass: "invalid",
    messages: {
      date_from: {
        required: "Выбирете даты",
      },
      date_to:{
        required: "Выбирете даты",
      },
    },
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "/booking/view",
        data: $(form).serialize(),

        // Ошибка отправки запроса
        error: () => {
          modal("Ошибка запроса, попробуйте перезагрузить страницу");
        },

        success: function (response) {
          $('.-js-schedule-booking').html(response);
          // Таблица с комнатоми
          $('.rooms__home').on('click', (e) => {
            if (e.target.className == 'rooms__more-btn' || e.target.className == 'rooms__more-btn rooms__more-btn--active') {
              e.target.classList.toggle('rooms__more-btn--active');
              e.delegateTarget.children['1'].classList.toggle('rooms__more--active');
            }
          })
        }

      });
    }
  });


});
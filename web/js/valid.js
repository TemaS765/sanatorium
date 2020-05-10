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

  // Форма на странице вожатого

  $('.accommodation-form').on('click', (e) => {
    if (e.target.className == 'accommodation-form__checkbox') {
      e.delegateTarget['1'].classList.toggle('accommodation-form__submit--active');
    }
  });

  $('.accommodation-form').validate({
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "/order/change-status",
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

          }else{
            // Ошибка с сервера
            modal(response["error"]["message"]);
          }
        }

      });
    }
  });

  // Валидация и отправка
  $('.doc-edit').each(function () {
    $(this).validate({
      submitHandler: function(form) {
        $.ajax({
          type: "POST",
          url: "/medical-card/save",
          data: $(form).serialize(),

          // Ошибка отправки запроса
          error: () => {
            modal("Ошибка запроса, попробуйте перезагрузить страницу");
          },

          success: function (response) {
            if (response["status"] == "OK") {
              $('.customers__table-more').removeClass('customers__table-more--active');
            }else{
              // Ошибка с сервера
              modal(response["error"]["message"]);
            }
          }

        });
      }
    });
  });

  // Форма медицинского работника
  // Отключение несовместимых лечений
  $('.doc-edit__treatment-input').on('click', (e) => {
    function exception(str1,str2){
      if (e.currentTarget.offsetParent.children[1].innerText == str1){
        let i = 0
        while (i < e.currentTarget.offsetParent.parentElement.children.length) {
          if (e.currentTarget.offsetParent.parentElement.children[i].innerText == ' ' + str2) {
            e.currentTarget.offsetParent.parentElement.children[i].classList.toggle('input-group--off')
          }
          i++;
        }
      }
      if (e.currentTarget.offsetParent.children[1].innerText == str2){
        let i = 0
        while (i < e.currentTarget.offsetParent.parentElement.children.length) {
          if (e.currentTarget.offsetParent.parentElement.children[i].innerText == ' ' + str1) {
            e.currentTarget.offsetParent.parentElement.children[i].classList.toggle('input-group--off')
          }
          i++;
        }
      }
    }
    exception('Электросон','Электрофорез');
    exception('Аромотерапия','Галокамера');
    exception('Массаж механический','Скипидарная ванна');

  });

  let form, data = '';

  $('.med-edit').on('click', (e) => {
    if (e.target.innerText  == "Подтвердить"){
      form = e.target.form

      let i = 0
      while (i < e.delegateTarget.children.length - 1){
        let j = 0
        while (j < e.delegateTarget.children[i].children[1].children.length) {
          if (e.delegateTarget.children[i].children[1].children[j].children[0].checked) {
            data += 'sch[' + i + ']' + '[' + i + ']' + encodeURI(e.delegateTarget.children[i].children[1].children[j].children[1].innerText) + '&';
          }
          j++;
        }
        i++;
      }

      $.ajax({
        type: "POST",
        url: "/treatment-schedule/save",
        data: $(form).serialize(),

        // Ошибка отправки запроса
        error: () => {
          modal("Ошибка запроса, попробуйте перезагрузить страницу");
        },

        success: function (response) {
          if (response["status"] == "OK") {

          }else{
            // Ошибка с сервера
            modal(response["error"]["message"]);
          }
        }

      });
    }
  })
});
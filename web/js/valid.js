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
  $('.services__form').validate({
    rules: {
      service: {
        required: true,
      },
      serviceDate: {
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
      serviceDate:{
        required: "Выберите дату исполнения",
      },
      executor:{
        required: "Напишите исполнителя",
      },
    },
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "", 
        data: // Тоже самое, что отдаёт .serialize(), но пришлось собирать так
          "&service=" + $('#service').val() + 
          "&cost=" + $('.services__cost')[0].innerHTML +
          "&serviceDate=" + $('#serviceDate').val() + 
          "&executor=" + $('#executor').val(),

        // Ошибка отправки запроса
        error: () => {
          modal("Ошибка запроса, попробуйте перезагрузить страницу");
        },

        success: function (response) {
          if (response["status"] == "OK") {
            modal("Выполнено успешно");
            $(form)[0].reset();
          }else{
            // Ошибка с сервера
            modal(response["error"]["message"]);
          }
        }
      });
    }
  });

  // Регистрация клиентов
  $('.reservation__form').validate({
    rules: {
      name: {
        required: true,
      },
      passport: {
        required: true,
      },
      dateOfBirth: {
        required: true,
      },
      phone: {
        required: true,
      },
      address: {
        required: true,
      },
      house: {
        required: true,
        regex: "^[а-дА-Д']{1,1}$"
      },
      room: {
        required: true,
        range: [1, 50]
      },
      dateStart: {
        required: true,
      },
      dateEnd: {
        required: true,
      },
    },
    errorClass: "invalid",
    messages: {
      name: {
        required: "Заполните ФИО",
      },
      passport: {
        required: "Заполните паспортные данные",
      },
      dateOfBirth: {
        required: "Заполните день рождения",
      },
      phone: {
        required: "Заполните номер телефона",
      },
      address: {
        required: "Заполните адрес",
      },
      house: {
        required: "Заполните корпус",
        regex: "Напишите букву (А-Д) "
      },
      room: {
        required: "Заполните комнату",
        range: "Номер комнаты (1-50)"
      },
      dateStart: {
        required: "Заполните дату прибывания в санатории",
      },
      dateEnd: {
        required: "Заполните дату прибывания в санатории",
      },
    },
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "", 
        data: $(form).serialize(),

        // Ошибка отправки запроса
        error: () => {
          modal("Ошибка запроса, попробуйте перезагрузить страницу");
        },

        success: function (response) {
          if (response["status"] == "OK") {
            modal("Выполнено успешно");
            $(form)[0].reset();
          }else{
            // Ошибка с сервера
            modal(response["error"]["message"]);
          }
        }
      });
    }
  });

  // Форма поиска свободных комнат 
  $('.rooms__form').validate({
    rules: {
      roomsDateStart: {
        required: true,
      },
      roomsDateEnd: {
        required: true,
      },
    },
    errorClass: "invalid",
    messages: {
      roomsDateStart: {
        required: "Выбирете даты",
      },
      roomsDateEnd:{
        required: "Выбирете даты",
      },
    },
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "", 
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
  });

  // Форма на странице вожатого
  
  $('.accommodation-form').on('click', (e) => {
    if (e.target.className == 'accommodation-form__checkbox') {
      e.delegateTarget['1'].classList.toggle('accommodation-form__submit--active');
    }
  })

  $('.accommodation-form').validate({
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "", 
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
  });

  // Форма врача терапевта
  // Активация радиобаттонов
  let radioActive = 0;
  $('.doc-edit__diet-input').on('click', (e) => {
    let i = 0;
    while(i < $('.doc-edit__diet-input').length){
      if ($('.doc-edit__diet-input')[i].checked) {
        radioActive = i + 1;
        $('.label-radio')[i].classList.add('checked');
      }else{
        $('.label-radio')[i].classList.remove('checked');
      }
      i++;
    }  
  })
  // Валидация и отправка
  $('.doc-edit').validate({
    submitHandler: function(form) {
      $.ajax({
        type: "POST",
        url: "", 
        data: 'diet=' + radioActive + '&' + 
        $('.doc-edit').serialize().replace('dietInput=on&',''),

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
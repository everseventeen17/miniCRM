$(document).ready(function () {
    class Popup {
        constructor(popupSelector) {
            this._popup = document.querySelector(popupSelector); //Принимает в конструктор единственный параметр — селектор попапа.
        }

        open() {
            this._popup.classList.add('popup_opened');
            document.addEventListener('keydown', this._handleEscClose)
        };

        close() {
            this._popup.classList.remove('popup_opened');
            document.removeEventListener('keydown', this._handleEscClose);
        };

        _handleEscClose = (evt) => {
            if (evt.key === "Escape") {
                this.close();
            }
        };

        setEventListeners() {
            this._popup.addEventListener('mousedown', (evt) => {
                if (evt.target.classList.contains('popup_opened') || evt.target.classList.contains('popup__close-btn')) {
                    this.close();
                }
            });
        }
    };

    const validationConfig = {
        inputSelector: '.form-control',
        submitButtonSelector: '.submit-btn',
        inactiveButtonClass: 'btn-disabled',
        inputErrorClass: 'input__error',
        errorClass: 'span__error_visible'
    };

    class FormValidator {
        constructor(config, formElement) {
            this._inputSelector = config.inputSelector
            this._submitButtonSelector = config.submitButtonSelector
            this._inactiveButtonClass = config.inactiveButtonClass
            this._inputErrorClass = config.inputErrorClass
            this._errorClass = config.errorClass
            this._formElement = formElement
            this._inputList = Array.from(this._formElement.querySelectorAll(this._inputSelector));
            this._buttonElement = this._formElement.querySelector(this._submitButtonSelector);
        }

        _showInputError(inputElement, errorMessage) {
            const errorElement = this._formElement.querySelector(`.span__error_${inputElement.name}`);
            inputElement.classList.add(this._inputErrorClass)
            errorElement.classList.add(this._errorClass)
            errorElement.textContent = errorMessage
        }

        _hideInputError(inputElement) {
            const errorElement = this._formElement.querySelector(`.span__error_${inputElement.name}`);
            inputElement.classList.remove(this._inputErrorClass)
            errorElement.classList.remove(this._errorClass)
            errorElement.textContent = ''
        }

        resetValidation() {
            this._toggleButtonState()
            this._inputList.forEach((inputElement) => {
                    this._hideInputError(inputElement);
                }
            )
        };

        _checkInputValidity(inputElement) {
            if (!inputElement.validity.valid) {
                this._showInputError(inputElement, inputElement.validationMessage)
            } else
                this._hideInputError(inputElement)
        }

        _hasInvalidInput() {
            return this._inputList.some((inputElement) => {
                return !inputElement.validity.valid
            })
        }

        _toggleButtonState() {
            if (this._hasInvalidInput()) {
                this._disableButton()
            } else {
                this._buttonElement.classList.remove(this._inactiveButtonClass)
                this._buttonElement.disabled = false
            }
        }

        _disableButton() {
            this._buttonElement.disabled = true;
            this._buttonElement.classList.add(this._inactiveButtonClass);
        };

        _setEventListeners() {
            this._toggleButtonState();
            this._inputList.forEach((inputElement) => {
                inputElement.addEventListener('input', () => {
                    this._checkInputValidity(inputElement)
                    this._toggleButtonState();
                })
            })
        }

        enableValidation() {
            this._setEventListeners();
        }
    }

    function validateEmail(mail) {
        let regex = /^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u;
        return regex.test(mail);
    }
    const createForm = document.querySelector('.form');
    if(typeof(createForm) != "undefined" && createForm !== null) {
        let createFormValidator = new FormValidator(validationConfig, createForm);
        createFormValidator.enableValidation();
    }

    //создание пользователя
    $('#create-user-form form').submit(function (e) {

        e.preventDefault();
        if ($('input[name="username"]').val().length <= 3) {
            $('#form_text_0').addClass('input__error');
        } else {
            $('#form_text_0').removeClass('input__error');
        }
        if ($('input[name="email"]').val().length <= 3 || !validateEmail($('input[name="email"]').val())) {
            $('#form_text_1').addClass('input__error');
        } else {
            $('#form_text_1').removeClass('input__error');
        }

        if ($('input[name="password"]').val().length < 3) {
            $('#form_text_2').addClass('input__error');
        } else {
            $('#form_text_2').removeClass('input__error');
        }

        if ($('input[name="confirm_password"]').val().length < 3 || $('input[name="confirm_password"]').val() !== $('input[name="password"]').val()) {
            $('#form_text_3').addClass('input__error');
        } else {
            $('#form_text_3').removeClass('input__error');
        }
        $.ajax({
            type: "POST",
            url: "index.php?page=users&action=store",
            dataType: 'text',
            data: $('#create-user-form form').serialize(),
            success: function (data) {
                console.log(data)
                if (data.indexOf('Имя пользователя должно быть не меньше 3-ех символов!') !== -1) {
                    $('#form_text_0').addClass('input__error');
                }
                else if (data.indexOf('Формат ввода email не верен') !== -1 || data.indexOf('Пользователь с данным email уже существует!') !== -1) {
                    $('#form_text_1').addClass('input__error');
                }
                else if (data.indexOf('Email должен быть короче 50 символов') !== -1) {
                    $('#form_text_1').addClass('input__error');
                }
                else if (data.indexOf('Длинна пароля должна быть не меньше 3 символов') !== -1) {
                    $('#form_text_2').addClass('input__error');
                }
                else if (data.indexOf('Пароли не совпадают') !== -1) {
                    $('#form_text_3').addClass('input__error');
                    return;
                }else{
                    let successPopup = new Popup('.popup');
                    successPopup.open();
                    successPopup.setEventListeners();
                }

            }
        })
    });

    //регистрация пользователя
    $('#register-user-form form').submit(function (e) {
        e.preventDefault();
        if ($('input[name="username"]').val().length <= 3) {
            $('#form_text_0').addClass('input__error');
        } else {
            $('#form_text_0').removeClass('input__error');
        }
        if ($('input[name="email"]').val().length <= 3 || !validateEmail($('input[name="email"]').val())) {
            $('#form_text_1').addClass('input__error');
        } else {
            $('#form_text_1').removeClass('input__error');
        }

        if ($('input[name="password"]').val().length < 3) {
            $('#form_text_2').addClass('input__error');
        } else {
            $('#form_text_2').removeClass('input__error');
        }

        if ($('input[name="confirm_password"]').val().length < 3 || $('input[name="confirm_password"]').val() !== $('input[name="password"]').val()) {
            $('#form_text_3').addClass('input__error');
        } else {
            $('#form_text_3').removeClass('input__error');
        }
        $.ajax({
            type: "POST",
            url: "index.php?page=signup&action=store",
            dataType: 'text',
            data: $('#register-user-form form').serialize(),
            success: function (data) {
                console.log(data)
                if (data.indexOf('Имя пользователя должно быть не меньше 3-ех символов!') !== -1) {
                    $('#form_text_0').addClass('input__error');
                }
                if (data.indexOf('Формат ввода email не верен') !== -1) {
                    $('#form_text_1').addClass('input__error');
                }
                if (data.indexOf('Email должен быть короче 50 символов') !== -1) {
                    $('#form_text_1').addClass('input__error');
                }
                if (data.indexOf('Длинна пароля должна быть не меньше 3 символов') !== -1) {
                    $('#form_text_2').addClass('input__error');
                }
                if (data.indexOf('Пароли не совпадают') !== -1) {
                    $('#form_text_3').addClass('input__error');
                }
                if (data.indexOf('Пользователь с данным email уже существует!') !== -1) {
                    $('#form_text_1').addClass('input__error');
                    $('.span__error_email').text('Пользователь с данным email уже существует!');
                    $('.span__error_email').addClass('span__error_visible');
                    return;
                }
                let successPopup = new Popup('.popup');
                successPopup.open();
                successPopup.setEventListeners();
            }
        })
    });

    //авторизация пользователя
    $('#login-user-form form').submit(function (e) {
        e.preventDefault();
        if ($(!validateEmail($('input[name="email"]').val()))) {
            $('#form_text_1').removeClass('input__error');
        } else {
            $('#form_text_1').addClass('input__error');
        }
        if ($('input[name="password"]').val().length < 3) {
            $('#form_text_2').addClass('input__error');
        } else {
            $('#form_text_2').removeClass('input__error');
        }
        $.ajax({
            type: "POST",
            url: "index.php?page=signin&action=auth",
            dataType: 'text',
            data: $('#login-user-form form').serialize(),
            success: function (data) {
                console.log(data)
                if (data.indexOf('Invalid email or password') !== -1) {
                    $('#form_text_1').addClass('input__error');
                    $('#form_text_2').addClass('input__error');
                    $('.span__error_email').text('Invalid email or password!');
                    $('.span__error_email').addClass('span__error_visible');
                    return;
                }
                let successPopup = new Popup('.popup');
                successPopup.open();
                successPopup.setEventListeners();
            }
        })
    });

    //удаление пользователя из базы данных
    $('.js-deleteUser').click(function (e) {
        e.preventDefault();
        console.log($('#deleteUser'))
        let userId = $(this).attr('data-user-id');
        let that = $(this);
        $.ajax({
            type: "POST",
            url: `index.php?page=users&action=delete&id=${userId}`,
            dataType: 'text',
            data: userId,
            success: function (data) {
                if (data) {
                    $(that).closest("tr").remove();
                } else {
                    console.log('Произошла ошибка при удалении пользователя');
                }
            }
        })
    });


    //создать роль
    $('#create-role-form form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "index.php?page=roles&action=store",
            dataType: 'text',
            data: $('#create-role-form form').serialize(),
            success: function (data) {
                console.log(data)
                if (data.indexOf('Такая роль уже существует!') !== -1) {
                    $('#form_text_0').addClass('input__error');
                    $('.span__error_role_name').text('Такая роль уже существует!');
                    $('.span__error_role_name').addClass('span__error_visible');
                } else if (data.indexOf('Имя роли обязательно!') !== -1) {
                    $('#form_text_0').addClass('input__error');
                    $('.span__error_role_name').text('Имя роли обязательно!');
                    $('.span__error_role_name').addClass('span__error_visible');
                } else if (data.indexOf('Описание роли обязательно!') !== -1) {
                    $('#form_text_1').addClass('input__error');
                    $('.span__error_role_description').text('Описание роли обязательно для заполнения!');
                    $('.span__error_role_description').addClass('span__error_visible');
                } else {
                    $('#form_text_0').removeClass('input__error');
                    $('#form_text_1').removeClass('input__error');
                    let successPopup = new Popup('.popup');
                    successPopup.open();
                    successPopup.setEventListeners();
                }
            }
        })
    })

    //создать сртаницу
    $('#create-page-form form').submit(function (e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "index.php?page=pages&action=store",
            dataType: 'text',
            data: $('#create-page-form form').serialize(),
            success: function (data) {
                console.log(data)
                if (data.indexOf('Такая страница уже существует!') !== -1) {
                    $('#form_text_0').addClass('input__error');
                    $('.span__error_page_name').text('Такая страница уже существует!');
                    $('.span__error_page_name').addClass('span__error_visible');
                } else if (data.indexOf('Имя страницы обязательно!') !== -1) {
                    $('#form_text_0').addClass('input__error');
                    $('.span__error_page_name').text('Имя страницы обязательно!');
                    $('.span__error_page_name').addClass('span__error_visible');
                } else if (data.indexOf('Ссылка на страницу обязательна!') !== -1) {
                    $('#form_text_1').addClass('input__error');
                    $('.span__error_page_url').text('Ссылка на страницу обязательна!');
                    $('.span__error_page_url').addClass('span__error_visible');
                } else {
                    $('#form_text_0').removeClass('input__error');
                    $('#form_text_1').removeClass('input__error');
                    let successPopup = new Popup('.popup');
                    successPopup.open();
                    successPopup.setEventListeners();
                }
            }
        })
    });

    //удаление роли из базы данных
    $('.js-deleteRole').click(function (e) {
        e.preventDefault();
        let roleId = $(this).attr('data-role-id');
        let that = $(this);
        $.ajax({
            type: "POST",
            url: `index.php?page=roles&action=delete&id=${roleId}`,
            dataType: 'text',
            data: roleId,
            success: function (data) {
                if (data) {
                    $(that).closest("tr").remove();
                } else {
                    console.log('Произошла ошибка при удалении роли');
                }
            }
        })
    });

    //удаление страницы из базы данных
    $('.js-deletePage').click(function (e) {
        e.preventDefault();
        let pageId = $(this).attr('data-page-id');
        let that = $(this);
        $.ajax({
            type: "POST",
            url: `index.php?page=pages&action=delete&id=${pageId}`,
            dataType: 'text',
            data: pageId,
            success: function (data) {
                if (data) {
                    $(that).closest("tr").remove();
                } else {
                    console.log('Произошла ошибка при удалении страницы');
                }
            }
        })
    });

});
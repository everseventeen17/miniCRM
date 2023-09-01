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

    class FormAjaxValidator {
        constructor(formElement, ajaxUrl, config) {
            this._inputSelector = config.inputSelector
            this._inputErrorClass = config.inputErrorClass
            this._errorClass = config.errorClass
            this._formElement = formElement
            this._ajaxUrl = ajaxUrl
            this._inputList = Array.from(this._formElement.querySelectorAll(this._inputSelector));
        }

        _hideInputError(inputElement) {
            const errorElement = this._formElement.querySelector(`.span__error_${inputElement.name}`);
            inputElement.classList.remove(this._inputErrorClass)
            errorElement.classList.remove(this._errorClass)
            errorElement.textContent = ''
        }
        resetValidation() {
            this._inputList.forEach((inputElement) => {
                    this._hideInputError(inputElement);
                }
            )
        };

        setEventListeners() {
            let url = this._ajaxUrl;
            let inputList = this._inputList;
            let formElement = this._formElement;
            let inputErrorClass = this._inputErrorClass
            let errorClass = this._errorClass
            let classConst = this

            this._formElement.addEventListener('submit', function (e) {
                e.preventDefault();
                $(this).find('button').attr('disabled', true);
                let that = $(this);
                $.ajax({
                    type: "POST",
                    url: url,
                    dataType: 'text',
                    data: $(this).serialize(),
                    success: function (data) {
                        const response = () => {
                            try {
                                return JSON.parse(data);
                            } catch (error) {
                                return null;
                            }
                        };
                        $(that).find('button').attr('disabled', false)
                        if (response() !== 'ok') {
                            $(response()).each(function (index, value) {
                                if (inputList[index].name == Object.keys(value)) {
                                    const errorElement = formElement.querySelector(`.span__error_${inputList[index].name}`);
                                    inputList[index].classList.add(inputErrorClass)
                                    errorElement.classList.add(errorClass)
                                    errorElement.textContent = value[inputList[index].name];
                                }
                            })
                        } else {
                            let successPopup = new Popup('.popup');
                            successPopup.open();
                            successPopup.setEventListeners();
                            classConst.resetValidation()
                        }
                    }
                })

            })
        }
    }

    class deleteButton {
        constructor(buttonSelector, ajaxUrl, dataId) {
            this._ajaxUrl = ajaxUrl;
            this._dataId = dataId;
            this._buttonList = Array.from(document.querySelectorAll(buttonSelector));
        }

        setEventListeners() {
            this._buttonList.forEach((buttonElement) => {
                buttonElement.addEventListener('click', (e) => {
                    e.preventDefault();
                    let pageId = buttonElement.getAttribute(this._dataId);
                    let that = buttonElement;
                    buttonElement.setAttribute('disabled', true);
                    $.ajax({
                        type: "POST",
                        url: `index.php?page=${this._ajaxUrl}&action=delete&id=${pageId}`,
                        dataType: 'text',
                        data: pageId,
                        success: function (data) {
                            if (data) {
                                $(that).closest("tr").remove();
                                that.setAttribute('disabled', false);
                            } else {
                                console.log('Произошла ошибка при удалении');
                            }
                        }
                    })
                })
            })
        }
    }

    //удаление страницы из базы данных
    let pageDeleteButton = new deleteButton('.js-deletePage', 'pages', 'data-page-id');
    pageDeleteButton.setEventListeners();
    //удаление ользователя из базы данных
    let userDeleteButton = new deleteButton('.js-deleteUser', 'users', 'data-user-id');
    userDeleteButton.setEventListeners();
    //удаление роли из базы данных
    let roleDeleteButton = new deleteButton('.js-deleteRole', 'roles', 'data-role-id');
    roleDeleteButton.setEventListeners();

    const createForm = document.querySelector('.form');
    if (typeof (createForm) != "undefined" && createForm !== null) {
        let createFormValidator = new FormValidator(validationConfig, createForm);
        createFormValidator.enableValidation();

        let formCreatePageValidator = new FormAjaxValidator(createForm, 'index.php?page=pages&action=store', validationConfig);
        formCreatePageValidator.setEventListeners();
        let formCreateUserValidator = new FormAjaxValidator(createForm, 'index.php?page=users&action=store', validationConfig);
        formCreateUserValidator.setEventListeners();
        let formRegisterUserValidator = new FormAjaxValidator(createForm, 'index.php?page=signup&action=store', validationConfig);
        formRegisterUserValidator.setEventListeners()
        let formAuthUserValidator = new FormAjaxValidator(createForm, 'index.php?page=signin&action=auth', validationConfig);
        formAuthUserValidator.setEventListeners();
        let formCreateRoleUserValidator = new FormAjaxValidator(createForm, 'index.php?page=roles&action=store', validationConfig);
        formCreateRoleUserValidator.setEventListeners();
    }
});
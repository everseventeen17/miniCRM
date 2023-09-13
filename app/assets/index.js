$(document).ready(function () {
    function isset(value) {
        return typeof (value) != "undefined" && value !== null ? true : false;
    }

    const hamb = document.querySelector("#hamb");
    const popup = document.querySelector("#popup");
    const body = document.body;

// Клонируем меню, чтобы задать свои стили для мобильной версии
    const menu = document.querySelector("#menu");

// При клике на иконку hamb вызываем ф-ию hambHandler
    hamb.addEventListener("click", hambHandler);

// Выполняем действия при клике ..
    function hambHandler(e) {
        e.preventDefault();
        // Переключаем стили элементов при клике
        popup.classList.toggle("open");
        hamb.classList.toggle("active");
        body.classList.toggle("noscroll");
        renderPopup();
    }

// Здесь мы рендерим элементы в наш попап
    function renderPopup() {
        popup.appendChild(menu);
    }

// Код для закрытия меню при нажатии на ссылку
    const links = Array.from(menu.children);

// Для каждого элемента меню при клике вызываем ф-ию
    links.forEach((link) => {
        link.addEventListener("click", closeOnClick);
    });

// Закрытие попапа при клике на меню
    function closeOnClick() {
        popup.classList.remove("open");
        hamb.classList.remove("active");
        body.classList.remove("noscroll");
    }


    const dueDateElements = document.querySelectorAll('.due-date');
    const plusDateElements = document.querySelectorAll('.plus-date');
    function updateRemainingTime() {
        const now = new Date();

        dueDateElements.forEach((element) => {
            const dueDate = new Date(element.getAttribute('data-finish_date'));
            const timeDiff = dueDate - now;
            if (timeDiff > 0) {
                const days = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                const hours = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                element.textContent = ` Days: ${days} Hours: ${hours} Minutes: ${minutes} remain`;
            } else {
                element.textContent = 'Time is up';
            }
        });
    }

    function updateWastedTime() {
        plusDateElements.forEach((element) => {
            if (element.getAttribute('data-status') == 'in_progress') {
                const now = new Date();
                let dueDate = new Date(element.getAttribute('data-started-at'));
                const timeDiff = now - dueDate;
                if (isset(element.getAttribute('data-time'))) {
                    let timeWithWastedFromServer = timeDiff + ((parseInt(element.getAttribute('data-time'))) * 1000 * 60)
                    const days = Math.floor(timeWithWastedFromServer / (1000 * 60 * 60 * 24));
                    const hours = Math.floor((timeWithWastedFromServer % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    const minutes = Math.floor((timeWithWastedFromServer % (1000 * 60 * 60)) / (1000 * 60));
                    element.textContent = `${days}d:${hours}h:${minutes}m`;
                } else {
                    element.textContent = "You haven't taken on this task yet";
                }
            }
        });
    }


    if (isset(plusDateElements)) {
        updateWastedTime();
        setInterval(updateWastedTime, 60000);
    }
    if (isset(dueDateElements)) {
        updateRemainingTime();
        setInterval(updateRemainingTime, 60000);
    }

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
        inputSelector: '.form-control-input',
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

            let inputList = this._inputList;
            let formElement = this._formElement;
            let url = formElement.getAttribute('action');
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
                        url: `/${this._ajaxUrl}/delete/${pageId}`,
                        dataType: 'text',
                        data: pageId,
                        success: function (data) {
                            if (data) {
                                $(that).closest("tr").remove();
                                $(that).closest(".accordion-item").remove();
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
    //удаление ТО DО категории из базы данных
    let todoDeleteButton = new deleteButton('.js-deleteTodoCategory', 'todo/category', 'data-todo-id');
    todoDeleteButton.setEventListeners();
    //удаление ТО DО Task из базы данных
    let todoTaskDeleteButton = new deleteButton('.js-deleteTodoTask', 'todo/tasks', 'data-todoTask-id');
    todoTaskDeleteButton.setEventListeners();

    const createForm = document.querySelector('.form');

    if (isset(createForm)) {
        let createFormValidator = new FormValidator(validationConfig, createForm);
        createFormValidator.enableValidation();
    }
});
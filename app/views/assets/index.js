$(document).ready(function () {
    function validateEmail(mail) {
        let regex = /^((([0-9A-Za-z]{1}[-0-9A-z\.]{1,}[0-9A-Za-z]{1})|([0-9А-Яа-я]{1}[-0-9А-я\.]{1,}[0-9А-Яа-я]{1}))@([-0-9A-Za-z]{1,}\.){1,2}[-A-Za-z]{2,})$/u;
        return regex.test(mail);
    }

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
                if (data.indexOf('Формат ввода email не верен') !== -1 || data.indexOf('Пользователь с данным email уже существует!') !== -1) {
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
            }
        })
    });

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
});
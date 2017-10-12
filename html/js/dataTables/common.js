//$(function () {
//$(document).ready(function() {

(function () {
    var app = {
        initialize: function () {
            this.setUpListeners();
        },
        setUpListeners: function () {
            $('form').on('submit', app.submitForm);
            $('form').on('keydown', 'input', app.removeError);
        },
        submitForm: function (e) {

            e.preventDefault();

            var form = $(this);
            submitBtn = form.find('button[type="submit"]');

            if (app.validateForm(form) === false)
                return false;

            var fio = $('#inputFio').val();
            var phone = $('#inputPhone').val();
            var remark = $('#inputRemark').val();

            $.ajax({
                url: "middleware/phone.php",
                cache: false,
                method: 'GET',
                data: {
                    'method': 'add',
                    'fio': fio,
                    'phone': phone,
                    'remark': remark
                },
                success: function (data) {
                    window.location.replace("http://hotger/?tmpt=phonebook");
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });
        },
        validateForm: function (form) {
            var inputs = $('#inputFio, #inputPhone');
            valid = true;

            inputs.tooltip('destroy');

            $.each(inputs, function (index, val) {
                var input = $(val),
                        val = input.val(),
                        formGroup = input.parents('.input-group'),
                        textError = 'Введите ';

                if (val.length === 0) {
                    formGroup.addClass('has-error').removeClass('has-success');
                    input.tooltip({
                        trigger: 'manual',
                        placement: 'right',
                        title: textError
                    }).tooltip('show');
                    valid = false;
                } else {
                    formGroup.addClass('has-success').removeClass('has-error');
                }

            });
            return valid;
        },
        removeError: function () {
            $(this).tooltip('destroy').parents('.input-group').removeClass('has-error');
        }
    };

    app.initialize();

}());

$(document).ready(function () {
    $('tbody td').click(function (e) {
        var t = e.target || e.srcElement;
        var elm_name = t.tagName.toLowerCase();
        var name = $(this).attr('name');
        var cid = $(this).parent().attr('id');

        if (elm_name == 'input') {
            return false;
        }

        var val = $(this).html();
        var code = '<input type="text" class="form-control" id="edit" value="' + val + '" />';

        $(this).empty().append(code);
        $('#edit').focus();

        // Сохранение по нажатию Enter
//        $('#edit').keyup(function (event) {
//            if (event.keyCode == 13) {
//            }
//        });

        $('#edit').blur(function () {
            var val = $(this).val();

            $.ajax({
                url: "middleware/phone.php",
                cache: false,
                method: 'GET',
                data: {
                    'method': 'upd',
                    'cid': cid,
                    'name': name,
                    'value': val
                },
                success: function (data) {
                },
                error: function (jqXHR, textStatus, errorThrown) {
                }
            });

            $(this).parent().empty().html(val);
        });
    });
});
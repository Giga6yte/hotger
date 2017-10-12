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

            var min = $('#inputMin').val();
            var max = $('#inputMax').val();

            $.ajax({
                url: "middleware/gen.php",
                cache: false,
                method: 'GET',
                data: {
                    'min': min,
                    'max': max
                },
                success: function (data) {
                    $('[for=output]').show();
                    $('[name=result]').val(data);
                    $('[name=result]').show();
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('[for=output]').show();
                    $('[name=result]').val('Вах, беда на беде! Очевидно обработчик не знает что делать при такой комбинации.');
                    $('[name=result]').show();
                }
            });
        },
        validateForm: function (form) {
            var inputs = form.find('[name=min]'),
                    valid = true;

            inputs.tooltip('destroy');

            $.each(inputs, function (index, val) {
                var input = $(val),
                        val = input.val(),
                        formGroup = input.parents('.form-group'),
                        label = formGroup.find('label').text().toLowerCase(),
                        textError = 'Введите ' + label;

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
            $(this).tooltip('destroy').parents('.form-group').removeClass('has-error');
        }
    };

    app.initialize();

}());

$(document).ready(function () {
    $('[for=output]').hide();
    $('[name=result]').hide();
});
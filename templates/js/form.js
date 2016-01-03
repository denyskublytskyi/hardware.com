$(document).ready(function() {
    $('.form-close-button').click(function() {
        $(this).parent('form').fadeOut("slow", function() {
            $(this).trigger('reset');
            $(this).children('.validation-error').remove();
            $(this).children("form-answer").empty();
        });
    });

    $('#sign-in-button').click(function(event) {
        event.preventDefault();
        $("#login-form").fadeIn("slow");
    });

    $('#sign-out-button').click(function() {
        location.reload(true);
    });

    $('#to-registration').click(function() {
        $("#login-form").fadeOut("slow", function() {
            $(this).trigger('reset');
            $(this).children('.validation-error').remove();
            $(this).children("form-answer").empty();
        });
        $("#registration-form").fadeIn("slow");
    });

    $('#to-login').click(function() {
        $("#registration-form").fadeOut("slow", function() {
            $(this).trigger('reset');
            $(this).children('.validation-error').remove();
            $(this).children("form-answer").empty();
        });
        $("#login-form").fadeIn("slow");
    });

    $('.form').submit(function(event) {
        event.preventDefault();

        var form = $(this);
        var inputs = $(this).children(':input:not(:button)');
        inputs.push($(this).children('.g-recaptcha'));
        console.log(inputs);

        var handler;
        switch($(this).attr('id'))
        {
            case 'feedback-form': handler = '/feedback';
                break;
            case 'login-form': handler = '/login';
                break;
            case 'registration-form': handler = '/registration';
                break;
        }
        console.log(handler);

        $.ajax({
            url: handler,
            type: 'post',
            dataType: 'json',
            data: $(this).serialize(),
            success: function(answer) {
                console.log(answer);
                inputs.each(function() {
                    var curAnswer = answer[$(this).attr('name')];
                    var next = $(this).next();

                    if (curAnswer == 'OK' || !curAnswer)
                    {
                        if (next.attr('class') == 'validation-error')
                            next.remove();
                    }
                    else
                    {
                        if (next.attr('class') == 'validation-error')
                            $(this).next().remove();
                        $(this).after("<div class = 'validation-error'>" + curAnswer + "</div>");
                    }
                });
                if (answer['answer'])
                {
                    if (form.attr('id') == 'feedback-form')
                        form.children('.form-answer').html(answer['answer']);
                    else
                    {
                        form.fadeOut('slow', function() {
                            $(this).trigger('reset');
                        });
                        location.reload(true);
                    }
                }
            }
        });
    });
});
$(document).ready(function() {
    $('#search-template').on('input', function() {
        console.log('search template changed');
        if ($(this).val().length >= 3) {
            var data = $('#search-form').serialize();

            $.post('/search', data, function (response) {
                if ($('#search-list').length)
                    $('#search-list').replaceWith(response);
                else
                    $('#search').append(response);
            });
        }
        else if ($('#search-list').length) {
            $('#search-list').fadeOut(400, function() {
                $(this).remove();
            })
        }
    });

    $('#search-template').on('focusout', function() {
        $('#search-list').fadeOut(400, function() {
            $(this).remove();
        })
    });
});
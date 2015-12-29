$(document).ready(function() {
    var links = [
        {link: 'category', ajax: 'category/viewajax'},
        {link: 'product', ajax: 'product/viewajax'},
        {link: 'filter', ajax: 'filterajax'}
    ];

    $('#menu').on('click', '.menu-item', function (event) {
        event.preventDefault();
        var href = $(this).attr('href');
        history.pushState(null, null, href);
        GetAndInsertContent(href, [links[0]]);
    });

    $('#search').on('click', '.search-item > a', function (event) {
        event.preventDefault();
        var href = $(this).attr('href');
        history.pushState(null, null, href);
        GetAndInsertContent(href, [links[1]]);
    });

    $('#content').on('click', '.product > a', function (event) {
        event.preventDefault();
        var href = $(this).attr('href');
        history.pushState(null, null, href);
        GetAndInsertContent(href, [links[1]]);
    });

    $('#filter').on('click', '.filter-subitem a', function(event) {
        event.preventDefault();
        var href = $(this).attr('href');
        GetAndInsertContent(href, [links[2]]);
    });

    $(window).on('popstate', function() {
        GetAndInsertContent(location.pathname, links)
    });
});

var GetAndInsertContent = function(href, data) {
    var url = href;

    $.each(data, function(i, value) {
        url = url.replace(value.link, value.ajax);
    });

    $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        success: function(data) {
            $.each(data, function(i, value) {
                $('#' + i).html(value);
            });
        }
    });
};
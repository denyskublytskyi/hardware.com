$(document).ready(function() {
    $('.product-page-rating a').click(function(event) {
        event.preventDefault();
        var url = $(this).attr('href').replace('rate', 'rateajax');
        var target = $(this);
        console.log(url);
        $.ajax(
            {
                url: url,
                type: 'post',
                success: function(rate) {
                    console.log(rate);
                    target.parent('.product-page-rating').children('a').each(function(i) {
                        if (rate >= 5 - i)
                            $(this).html('<i class="fa fa-star"></i>');
                        else if (rate == 5 - i - 0.5)
                            $(this).html('<i class="fa fa-star-half-o"></i>');
                        else
                            $(this).html('<i class="fa fa-star-o"></i>');
                    });
                }
            }
        );
    });
});
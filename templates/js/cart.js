$(document).ready(function() {
    $('.cart').on('click', '.cart-button', showCart);

    $('#content').on('click', '.add-to-cart', function(event) {
        event.preventDefault();
        var url = $(this).attr('href').replace('add', 'addajax');
        console.log('add to cart ' + url);
        getCart(url);
    });

    $('.cart').on('click', '.cart-item-delete', function(event) {
        event.preventDefault();
        var url = $(this).attr('href').replace('delete', 'deleteajax');
        console.log('delete cart ' + url);
        getCart(url);
    });
});

var showCart = function (event) {
    var cartList = $('.cart ul');
    if (cartList.css('display') == 'none')
        cartList.fadeIn(400);
    else
        cartList.fadeOut(400);
}

function updateCart(answer)
{
    var isShowed = ($('.cart ul').css('display') != 'none') ? true : false;
    $('.cart').html(answer);
    if(isShowed)
        $('.cart ul').css('display', 'block');
}

function getCart(url) {
    $.ajax({
        url: url,
        type: 'post',
        success: function(answer) {
            updateCart(answer);
        }
    });
}
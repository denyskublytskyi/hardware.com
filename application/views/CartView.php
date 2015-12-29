<div class='cart-button'>
    <i class='fa fa-shopping-cart'></i>
    <div>
        КОРЗИНА: <? echo CartModel::getProductCount(); ?> ШТ.
        <i class='fa fa-angle-down'></i>
    </div>
</div>
<ul>
    <?php if (CartModel::isEmpty()): ?>
        <div class="list-message"> В корзине нет ни одного товара. </div>
    <?php else: ?>
        <div class="list-message"> В корзине <? echo CartModel::getProductCount(); ?> товара(ов). </div>
    <?php endif; ?>
    <?php if (!CartModel::isEmpty()) foreach (CartModel::getCartList() as $id => $cartItem): ?>
        <li class='cart-item'>
            <a class='cart-item-delete' href="/cart/delete/<? echo $id; ?>">
                <i class='fa fa-times'></i>
            </a>
            <div class='cart-item-image'>
                <img src='<? echo '/templates/images/' . $cartItem['image'] ?>'>
            </div>
            <div class="cart-item-info">
                <div>
                    <? echo $cartItem['manufacturer'] . ' ' . $cartItem['name']; ?>
                </div>
                <div>
                    <b>
                        <? echo $cartItem['count'] . ' X ' . $cartItem['price']; ?>
                        <i class='fa fa-usd'></i>
                    </b>
                </div>
            </div>
        </li>
        <?php $summaryPrice += $cartItem['count'] * $cartItem['price']; ?>
    <?php endforeach; ?>
    <?php if (!CartModel::isEmpty()): ?>
    <div class="cart-sum">
        Итого в корзине:
        <b>
            <? echo $summaryPrice; ?>
            <i class='fa fa-usd'></i>
        </b>
    </div>
    <?php endif; ?>
</ul>
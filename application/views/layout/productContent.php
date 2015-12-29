    <div class="product-page-image">
        <img src="/templates/images/<? echo $product['image']; ?>">
    </div>
    <div class="product-page-info">
        <div class="product-page-title">
            <? echo $product['attributes']['Производитель'] . ' ' . $product['name']; ?>
        </div>
        <div class="product-aviability">
            Статус:
            <?php if($product['status'] = '0'): ?>
                <span class="is-available">
                            Есть в наличии
                        </span>
            <?php else: ?>
                <span class="is-not-available">
                            Нет в наличии
                        </span>
            <?php endif; ?>
        </div>
        <div class="product-page-rating">
            <?php for($i = 5; $i > 0; $i--): ?>
                <a href="/product/rate/<? echo $productId . '/' . $i; ?>">
                    <?php if ($rate >= $i): ?>
                        <i class="fa fa-star"></i>
                    <?php elseif ($rate == $i - 0.5): ?>
                        <i class="fa fa-star-half-o"></i>
                    <?php else: ?>
                        <i class="fa fa-star-o"></i>
                    <?php endif; ?>
                </a>
            <?php endfor; ?>
        </div>
        <div class="product-page-price">
            <? echo $product['price']; ?>
            $
        </div>
        <div class="product-page-description">
            <? echo $product['description']; ?>
        </div>
        <div class="product-page-add-to-cart">
            <a href ='/cart/add/<? echo $productId; ?>' class='button add-to-cart'>
                <div>
                    Добавить в корзину
                </div>
            </a>
        </div>
    </div>
    <div class='item-title product-page-item-title'>
        Подробности
    </div>
    <?php foreach($product['attributes'] as $attribute => $value): ?>
        <div class="product-attribute">
            <div class="product-attribute-name">
                <b>
                    <? echo $attribute; ?>
                </b>
            </div>
            <div class="product-attribute-value">
                <? echo $value; ?>
            </div>
        </div>
    <?php endforeach; ?>
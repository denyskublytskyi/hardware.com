<ul>
    <div class='item-title'>
        <? echo CategoryController::getCategoryDescription($category); ?>
    </div>
    <?php foreach(CategoryModel::getFilteredProductsList($category) as $product): ?>
        <li class='product-box'>
            <div class='product'>
                <a href='/product/<? echo $product['id']; ?>'>
                    <div class='product-image'>
                        <img src='<? echo '/templates/images/' . $product['image']; ?>'>
                    </div>
                </a>
                <div class='product-shop'>
                    <div class='product-price'>
                        <? echo $product['price']; ?>
                        <i class='fa fa-usd'></i>
                    </div>
                    <div class='product-name'>
                        <a href='/product/<? echo $product['id']; ?>'>
                            <? echo $product['manufacturer'] . ' ' . $product['name']; ?>
                        </a>
                    </div>
                    <div>
                        <a href ='/cart/add/<? echo $product['id']; ?>' class='button add-to-cart'>
                            <i class="fa fa-cart-plus"></i>
                            <div>
                                Добавить в корзину
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </li>
    <?php endforeach; ?>
</ul>
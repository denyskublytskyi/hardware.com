<ul id="search-list">
    <?php if (empty($productList)): ?>
        <div class="list-message"> Нет результатов. </div>
    <?php else: ?>
        <div class="list-message">
            Найдено <? echo count($productList); ?> товара(ов)
        </div>
        <?php foreach ($productList as $product): ?>
            <li class="search-item">
                <a href='/product/<? echo $product['id']; ?>'>
                    <div class='list-item-image'>
                        <img src='<? echo '/templates/images/' . $product['image'] ?>'>
                    </div>
                    <div class="search-item-info">
                        <div>
                            <? echo $product['manufacturer'] . ' ' . $product['name']; ?>
                        </div>
                        <div class="search-item-price">
                            <b>
                                <? echo $product['price']; ?>
                                <i class='fa fa-usd'></i>
                            </b>
                        </div>
                    </div>
                </a>
            </li>
        <?php endforeach; ?>
    <?php endif; ?>
</ul>
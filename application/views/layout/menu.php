    <ul>
        <div class='item-title'>
            Категории
        </div>
        <?php foreach(CategoryModel::getCategories() as $item): ?>
            <li>
                <a href="<? echo 'http://' . $_SERVER['SERVER_NAME'] . '/category/' . $item['name']; ?>" class='menu-item'>
                    <? echo $item['description']; ?>
                </a>
            </li>
        <?php endforeach; ?>
    </ul>
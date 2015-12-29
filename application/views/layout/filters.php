
    <ul>
        <div class='item-title'>
            Фильтры
        </div>
        <?php if(CategoryModel::isActiveFilters($category)): ?>
            <div class='item-subtitle'>
                Вы выбрали
            </div>
            <?php foreach(CategoryModel::getActiveFilters($category) as $key => $filter): ?>
                <li class='filter-item'>
                    <? echo $key; ?>
                    <ul>
                        <?php foreach($filter as $value): ?>
                            <li class='filter-subitem'>
                                <i class='fa fa-angle-right'></i>
                                <a href='/category/filter/<? printf('%s/%s/%s', $category, $key, $value); ?>'>
                                    <? echo $value; ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        <div class='item-subtitle'>
            Доступные параметры
        </div>
        <?php foreach(CategoryModel::getFilterListByCategory($category) as $key => $filter): ?>
            <li class='filter-item'>
                <? echo $key; ?>
                <ul>
                    <?php foreach($filter as $value): ?>
                        <li class='filter-subitem'>
                            <i class='fa fa-angle-right'></i>
                            <a href='/category/filter/<? printf('%s/%s/%s', $category, $key, $value); ?>'>
                                <? echo $value; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endforeach; ?>
    </ul>
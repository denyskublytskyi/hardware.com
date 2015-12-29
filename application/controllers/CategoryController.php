<?php

class CategoryController
{
    public static function actionView($category = 'cpu')
    {
        include ROOT . '/application/views/CategoryView.php';
    }

    public static function actionViewajax($category = 'cpu')
    {
        $content = self::getContent($category);
        exit(json_encode($content));
    }

    public static function actionFilter($category, $filter, $value)
    {
        CategoryModel::addFilter($category, $filter, $value);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function actionFilterAjax($category, $filter, $value)
    {
        CategoryModel::addFilter($category, $filter, $value);

        $content = self::getContent($category);
        exit(json_encode($content));
    }

    private static function getContent($category)
    {
        $content = array();

        ob_start();
        include ROOT . '/application/views/layout/categoryContent.php';
        $content['content'] = ob_get_clean();

        ob_start();
        include ROOT . '/application/views/layout/filters.php';
        $content['filter'] = ob_get_clean();

        return $content;
    }

    public static function getCategoryDescription($category)
    {
        $categoryList = CategoryModel::getCategories();
        foreach($categoryList as $item)
            if ($item['name'] == $category)
                return $item['description'];
    }
}
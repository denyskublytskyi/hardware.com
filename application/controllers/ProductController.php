<?php

class ProductController
{
    public static function actionView($productId)
    {
        $product = ProductModel::getProductById($productId);

        include ROOT . '/application/views/ProductView.php';
    }

    public static function actionViewajax($productId)
    {
        $product = ProductModel::getProductById($productId);

        ob_start();
        include ROOT . '/application/views/layout/productContent.php';
        $content['content'] = ob_get_clean();
        $content['filter'] = '';

        exit(json_encode($content));
    }

    public static function actionRateajax($id, $rate)
    {
        ProductModel::addRating($id, $rate);
        exit(ProductModel::getRating($id));
    }

    public static function actionRate($id, $rate)
    {
        ProductModel::addRating($id, $rate);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function actionSearch()
    {
        $template = $_POST['template'];

        $productList = ProductModel::search($template);
        include_once ROOT . '/application/views/layout/search.php';
    }
}
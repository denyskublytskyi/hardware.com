<?php

class CartController
{
    public static function actionAdd($id)
    {
        CartModel::addProduct($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function actionAddajax($id)
    {
        CartModel::addProduct($id);
        include_once ROOT . "/application/views/CartView.php";
    }

    public static function actionDelete($id)
    {
        CartModel::deleteProduct($id);
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function actionDeleteajax($id)
    {
        CartModel::deleteProduct($id);
        include_once ROOT . "/application/views/CartView.php";
    }
}
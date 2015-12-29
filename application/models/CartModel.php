<?php

class CartModel
{
    public static function getProductCount()
    {
        $count = 0;

        if (isset($_SESSION['cart'])) {
            $cart = $_SESSION['cart'];
            foreach ($cart as $product)
                $count += $product;
        }

        return $count;
    }

    public static function getCart()
    {
        return $_SESSION['cart'];
    }

    public static function isEmpty()
    {
        return count($_SESSION['cart']) == 0 ? true : false;
    }

    public static function addProduct($id)
    {
        if (isset($_SESSION['cart']))
            $cart = $_SESSION['cart'];
        else
            $cart = array();

        if (array_key_exists($id, $cart))
            $cart[$id]++;
        else
            $cart[$id] = 1;

        $_SESSION['cart'] = $cart;
    }

    public static function deleteProduct($id)
    {
        $cart = $_SESSION['cart'];

        if (isset($cart[$id])) {
            if ($cart[$id] != 1)
                $cart[$id]--;
            else
                unset($cart[$id]);
        }

        $_SESSION['cart'] = $cart;
    }

    public static function getCartList()
    {
        if (isset($_SESSION['cart']))
        {
            $cart = $_SESSION['cart'];

            $pdo = Db::connect();
            $cartList = array();

            foreach ($cart as $id => $count)
            {
                $sql = sprintf("SELECT product_attribute.value AS manufacturer, product.name, price, image FROM product
                    JOIN product_attribute ON product.id = product_attribute.product_id
                    JOIN attribute ON product_attribute.attribute_id = attribute.id
                    AND attribute.name = 'Производитель' WHERE product.id = '%s'",
                    $id);
                $cartList[$id] = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
                $cartList[$id]['count'] = $count;
            }
        }
        return $cartList;
    }
}
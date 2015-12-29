<?php

class ProductModel
{
    public static function getProductsList()
    {
        $pdo = Db::connect();
        $sql = "SELECT product.id, product_attribute.value AS manufacturer, product.name, category.description AS category, image FROM product
            JOIN category ON product.category_id = category.id
            JOIN product_attribute ON product.id = product_attribute.product_id
            JOIN attribute ON product_attribute.attribute_id = attribute.id AND attribute.name = 'Производитель'";
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getProductById($id)
    {
        $pdo = Db::connect();

        $sql = sprintf("SELECT product.name, price, image, status, description FROM product WHERE product.id = '%s'",
            $id);
        $product = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

        $sql = sprintf("SELECT attribute.name, product_attribute.value FROM product
            JOIN product_attribute ON product.id = product_attribute.product_id
            JOIN attribute ON product_attribute.attribute_id = attribute.id WHERE product.id = '%s'",
            $id);

        foreach($pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC) as $row)
            $attributes[$row['name']] = $row['value'];

        $product['attributes'] = $attributes;

        return $product;
    }

    public static function addRating($id, $rate)
    {
        $pdo = Db::connect();
        $sql = sprintf("INSERT INTO rating(product_id, login, rate) VALUES('%s', '%s', '%s')",
            $id,
            UserModel::getUser(),
            $rate);
        $pdo->exec($sql);
    }

    public static function getRating($id)
    {
        $pdo = Db::connect();
        $sql = sprintf("SELECT ROUND(AVG(rate) * 2, 0) / 2 as rate FROM rating WHERE product_id = '%s'",
            $id);
        $result = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
        return $result['rate'];
    }

    public static function search($template)
    {
        $pdo = Db::connect();
        $sql = sprintf("SELECT product.id, product_attribute.value AS manufacturer, product.name, product.price, category.description AS category, image FROM product
            JOIN category ON product.category_id = category.id
            JOIN product_attribute ON product.id = product_attribute.product_id
            JOIN attribute ON product_attribute.attribute_id = attribute.id AND attribute.name = 'Производитель' WHERE CONCAT_WS(' ', product_attribute.value, product.name) LIKE '%s'",
            $template . '%');
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
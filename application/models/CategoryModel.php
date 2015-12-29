<?php

class CategoryModel
{
    public static function getCategories()
    {
        $pdo = Db::connect();
        $sql = "SELECT description, name FROM category ORDER BY category.order";
        $stmt = $pdo->query($sql);

        $category = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            $category[] = array('description' => $row['description'],
                'name' => $row['name']);

        return $category;
    }

    public static function getProductListByCategory($category)
    {
        $pdo = Db::connect();
        $sql = sprintf("SELECT product.id, product_attribute.value AS manufacturer, product.name, price, image FROM product
            JOIN category ON product.category_id = category.id AND category.name = '%s'
            JOIN product_attribute ON product.id = product_attribute.product_id
            JOIN attribute ON product_attribute.attribute_id = attribute.id AND attribute.name = 'Производитель'",
            $category);
        $stmt = $pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getFilterListByCategory($category)
    {
        $pdo = Db::connect();
        $sql = sprintf("SELECT DISTINCT attribute.name FROM product
		    JOIN category ON product.category_id = category.id AND category.name = '%s'
		    JOIN product_attribute ON product.id = product_attribute.product_id
		    JOIN attribute ON product_attribute.attribute_id = attribute.id",
            $category);
        $stmt = $pdo->query($sql);

        $filters = array();
        $activeFilters = self::getActiveFilters($category);

        foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $attribute)
        {
            $attributeName = $attribute['name'];

            $sql = sprintf("SELECT DISTINCT product_attribute.value FROM product
			    JOIN category ON product.category_id = category.id AND category.name = '%s'
				JOIN product_attribute ON product.id = product_attribute.product_id
				JOIN attribute ON product_attribute.attribute_id = attribute.id AND attribute.name = '%s'",
                $category,
                $attributeName);
            $stmt = $pdo->query($sql);

            foreach ($stmt->fetchAll(PDO::FETCH_ASSOC) as $attributeValue)
                if(!isset($activeFilters[$attributeName]) or !in_array($attributeValue['value'], $activeFilters[$attributeName]))
                    $filters[$attributeName][] = $attributeValue['value'];
        }

        return $filters;
    }

    public static function addFilter($category, $filter, $value)
    {
        $filters = array();
        if (isset($_SESSION['filters'][$category]))
            $filters = $_SESSION['filters'][$category];
        if (!isset($filters[$filter]))
            $filters[$filter] = array();

        if (($key = array_search($value, $filters[$filter])) === false)
            $filters[$filter][] = $value;
        else
            unset($filters[$filter][$key]);

        if (empty($filters[$filter]))
            unset($filters[$filter]);

        if (empty($filters))
            unset($_SESSION['filters'][$category]);
        else
            $_SESSION['filters'][$category] = $filters;
    }

    public static function getActiveFilters($category)
    {
        return isset($_SESSION['filters'][$category]) ? $_SESSION['filters'][$category] : array();
    }

    public static function isActiveFilters($category)
    {
        return isset($_SESSION['filters'][$category]) ? true : false;
    }

    public static function getFilteredProductsList($category)
    {
        $pdo = Db::connect();
        $sqlBase = sprintf(" FROM product
            JOIN category ON product.category_id = category.id AND category.name = '%s'
            JOIN product_attribute ON product.id = product_attribute.product_id
            JOIN attribute ON product_attribute.attribute_id = attribute.id",
            $category);
        $sqlSelectAllColumns = "SELECT product.id, product_attribute.value AS manufacturer, product.name, price, image" . $sqlBase;
        $sqlSelectIdColumn = "SELECT product.id" . $sqlBase;

        $filters = self::getActiveFilters($category);
        if (!empty($filters))
        {
            $sqlTemplate = "%s WHERE product.id IN (%s)";
            $sql = sprintf("%s AND attribute.name = '%s' AND product_attribute.value IN (%s)",
                count($filters) == 1 ? $sqlSelectAllColumns : $sqlSelectIdColumn,
                key($filters),
                "'" . implode("', '", array_shift($filters)) . "'");

            foreach ($filters as $filter => $value) {
                $temp = sprintf("%s AND attribute.name = '%s' AND product_attribute.value IN (%s)",
                    $value === end($filters) ? $sqlSelectAllColumns : $sqlSelectIdColumn,
                    $filter,
                    "'" . implode("', '", $value) . "'");
                $sql = sprintf($sqlTemplate, $temp, $sql);
            }
        }
        else
            $sql = $sqlSelectAllColumns . " AND attribute.name = 'Производитель'";

        $result = $pdo->query($sql);

        return $result != null ? $result->fetchAll(PDO::FETCH_ASSOC) : array();
    }
}
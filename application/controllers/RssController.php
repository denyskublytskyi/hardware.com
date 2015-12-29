<?php

class RssController
{
    public static function actionView()
    {
        header('Content-Type: text/xml; charset=utf-8');

        $rss = new SimpleXMLElement('<rss></rss>');
        $rss->addAttribute('version', '2.0');

        $channel = $rss->addChild('channel');
        $channel->addChild('title', 'HardWare итернет-магазин');
        $channel->addChild('link', 'hardware.com');
        $channel->addChild('generator', 'PHP Simple XML');

        foreach(ProductModel::getProductsList() as $product)
        {
            $item = $channel->addChild('item');
            $item->addChild('title', $product['manufacturer'] . ' ' . $product['name']);
            $item->addChild('category', $product['category']);
            $item->addChild('guid', 'http://' . $_SERVER['SERVER_NAME'] . '/rss/' . $product['id']);
            $item->addChild('link', 'http://' . $_SERVER['SERVER_NAME'] . '/rss/' . $product['id']);
            $item->addChild('guid', 'http://' . $_SERVER['SERVER_NAME'] . '/product/' . $product['id']);
            $item->addChild('link', 'http://' . $_SERVER['SERVER_NAME'] . '/product/' . $product['id']);
        }

        echo $rss->asXML();
    }

    public static function actionItem($id)
    {
        header('Content-Type: text/xml; charset=utf-8');

        $rss = new SimpleXMLElement('<rss></rss>');
        $rss->addAttribute('version', '2.0');

        $channel = $rss->addChild('channel');
        $channel->addChild('title', 'HardWare итернет-магазин');
        $channel->addChild('link', 'hardware.com');
        $channel->addChild('generator', 'PHP Simple XML');

        $product = ProductModel::getProductById($id);
        $item = $channel->addChild('item');
        $image = $item->addChild('image');
        $image->addChild('guid', 'http://' . $_SERVER['SERVER_NAME'] . '/images/' . $product['image']);
        $image->addChild('link', 'http://' . $_SERVER['SERVER_NAME'] . '/images/' . $product['image']);
        $item->addChild('title', $product['manufacturer'] . ' ' . $product['name']);
        $item->addChild('category', $product['category']);
        $item->addChild('description', strip_tags($product['description']));
        $item->addChild('guid', 'http://' . $_SERVER['SERVER_NAME'] . '/product/' . $id);
        $item->addChild('link', 'http://' . $_SERVER['SERVER_NAME'] . '/product/' . $id);

        echo $rss->asXML();
    }
}
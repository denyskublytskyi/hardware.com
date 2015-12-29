<?php

class MessagesModel
{
    public static function getMessagesList($page, $order)
    {
        $pdo = Db::connect();
        $sql = sprintf("SELECT * FROM feedback ORDER BY date %s LIMIT %s, %s",
            $order,
            ($page - 1) * 10,
            $page * 10);
        $stmt = $pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getMessagesCount()
    {
        $pdo = Db::connect();
        $sql = "SELECT COUNT(*) AS count FROM feedback";
        $stmt = $pdo->query($sql)->fetch(PDO::FETCH_ASSOC);

        return $stmt['count'];
    }

    public static function deleteMessageById($id)
    {
        $pdo = Db::connect();
        $sql = sprintf("DELETE FROM feedback WHERE id = %s", $id);
        $pdo->exec($sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function deleteAllMessages()
    {
        $pdo = Db::connect();
        $sql = 'TRUNCATE TABLE feedback';
        $pdo->exec($sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function replyMessageById($id, $text)
    {
        $pdo = Db::connect();
        $sql = sprintf("UPDATE feedback SET answer = '%s' WHERE id = %s",
            $text,
            $id);
        $pdo->exec($sql);

        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }
}
<?php

class MessagesController
{
    public static function actionView($page = 1, $order = 'DESC')
    {
        $messages = MessagesModel::getMessagesList($page, $order);
        $count = MessagesModel::getMessagesCount();

        include_once ROOT . '/application/views/MessagesView.php';
    }

    public static function actionDelete($id)
    {
        MessagesModel::deleteMessageById($id);
    }

    public static  function  actionDeleteAll()
    {
        MessagesModel::deleteAllMessages();
    }

    public static function actionReply($id)
    {
        $text = $_POST['text'];
        MessagesModel::replyMessageById($id, $text);
    }
}
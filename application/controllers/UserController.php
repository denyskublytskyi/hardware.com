<?php

class UserController
{
    public static function actionRegistration()
    {
        extract($_POST);
        UserModel::registration($login, $password, $passwordConfirm, $email);
    }

    public static function actionLogin()
    {
        extract($_POST);
        UserModel::login($login, $password);
    }

    public static function actionLogout()
    {
        setcookie('login', '');
        setcookie('email', '');
        header('Location: ' . $_SERVER['HTTP_REFERER']);
    }

    public static function actionFeedback()
    {
        extract($_POST);
        UserModel::feedback($name, $email, $text);
    }
}
<?php

class UserModel
{
    public static function registration($login, $password, $passwordConfirm, $email)
    {
        $login = self::clear($login);
        $error = array(
            'login' => self::isLoginExist($login) ? 'Пользователь с таким логином уже существует.' : 'OK',
            'email' => self::isEmailExist($email) ? 'Пользователь с таким email уже существует.' : 'OK'
        );
        $error['login'] = self::checkName($login);
        $error['email'] = self::checkEmail($email);
        $error = array_merge($error, self::comparePasswords($password, $passwordConfirm));

        if ($error['login'] == 'OK'
            and $error['email'] == 'OK'
            and $error['password'] == 'OK'
            and $error['passwordConfirm'] == 'OK')
        {
            $error['answer'] = 'OK';
            self::saveUser($login, $password, $email);

            setcookie('login', $login, time() + 3600);
            setcookie('email', $email, time() + 3600);
        }

        exit(json_encode($error));
    }

    public  static function login($login, $password)
    {
        $pdo = Db::connect();
        $error = array();

        $sql = sprintf("SELECT password, email FROM user WHERE login = '%s'", $login);
        $stmt = $pdo -> query($sql);

        if ($stmt -> rowCount() == 0)
            $error['login'] = 'Неверный логин.';
        else
        {
            $user = $stmt -> fetch();
            $hash = $user['password'];

            if (password_verify($password, $hash))
            {
                $error['answer'] = 'ОК';

                setcookie('login', $login, time() + 3600);
                setcookie('email', $user['email'], time() + 3600);
            }
            else
                $error['password'] = 'Неверный пароль.';
        }

        exit(json_encode($error));
    }

    public static function feedback($name, $email, $text)
    {
        $name = self::clear($name);
        $email = self::clear($email);
        $text = self::clear($text);

        $error = array(
            'name' => self::checkName($name),
            'email' => self::checkEmail($email),
            'text' => self::checkMessage($text),
        );

        if ($error['name'] == 'OK'
            and $error['email'] == 'OK'
            and $error['text'] == 'OK')
        {
            $error['answer'] = 'Спасибо ' . $name . ', мы свяжемся с Вами!';
            self::saveMessage($name, $email, $text);
        }

        exit(json_encode($error));
    }

    public static function getUser()
    {
        return $_COOKIE['login'];
    }

    private function saveMessage($name, $email, $text)
    {
        $ip = getenv('REMOTE_ADDR');

        $pdo = Db::connect();
        $sql = $sql = sprintf("INSERT INTO feedback (name, email, text, date, ip) VALUES('%s', '%s', '%s', NOW(), '%s')",
            $name,
            $email,
            $text,
            $ip);

        $pdo->exec($sql);
    }

    private function saveUser($login, $password, $email, $type = 1)
    {
        $pdo = Db::connect();
        $password = password_hash($password, PASSWORD_DEFAULT);

        $sql = sprintf("INSERT INTO user (login, password, email, type) VALUES('%s', '%s', '%s', '%s')",
            $login,
            $password,
            $email,
            $type);

        $pdo -> exec($sql);
    }

    private function isLoginExist($login)
    {
        $pdo = Db::connect();

        $sql = sprintf("SELECT login FROM user WHERE login = '%s'", $login);

        if ($pdo -> query($sql) -> rowCount() == 0)
            return false;
        return true;
    }

    private function isEmailExist($email)
    {
        $pdo = Db::connect();

        $sql = sprintf("SELECT login FROM user WHERE email = '%s'", $email);

        if ($pdo -> query($sql) -> rowCount() == 0)
            return false;
        return true;
    }

    private function comparePasswords($password, $passwordConfirm)
    {
        $error = array();
        if (empty($password))
            $error['password'] = 'Пароль не может быть пустым.';
        elseif ($password != $passwordConfirm)
            $error['passwordConfirm'] = 'Пароли не совпадают.';
        else
        {
            $error['password'] = 'OK';
            $error['passwordConfirm'] = 'OK';
        }

        return $error;
    }

    private function checkName($name)
    {
        if (!empty($name))
            return 'OK';
        return 'Некорректное имя.';
    }

    private function checkEmail($email)
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL))
            return 'OK';
        return 'Неверный email.';
    }

    private function checkMessage($text)
    {
        if (strlen($text) >= 6)
            return 'OK';
        return 'Сообщение должно содержать не менее 6 символов.';
    }

    private function clear($value)
    {
        return htmlspecialchars(strip_tags(trim($value)));
    }
}
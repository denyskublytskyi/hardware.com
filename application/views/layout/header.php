<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <title>HardWare итернет-магазин</title>
    <link href='/templates/css/fonts.css' rel='stylesheet'>
    <link href='/templates/images/favicon.png' rel='icon' type='image/png' size='32x32'>
    <link href='/templates/css/style.css' rel='stylesheet'>
    <link href='/templates/css/font-awesome-4.4.0/css/font-awesome.min.css' rel='stylesheet' >
    <script src='/templates/js/jquery-2.1.4.js'></script>
    <script src='/templates/js/jquery.color-2.1.0.min.js'></script>
    <script src='/templates/js/form.js'></script>
    <script src='/templates/js/rating.js'></script>
    <script src='/templates/js/menu.js'></script>
    <script src='/templates/js/cart.js'></script>
    <script src='/templates/js/search.js'></script>
</head>

<body>
    <header>
        <div id='header-top'>
                    <span id='welcome-msg'>
                        <?php if (!isset($_COOKIE['login'])): ?>
                            Добро пожаловать в наш интернет-магазин!
                        <?php else: ?>
                            Добро пожаловать в наш интернет-магазин, <? echo $_COOKIE['login']; ?> !
                        <? endif; ?>
                    </span>
            <div id='header-links'>
                <ul>
                    <li>
                        Оформить заказ
                    </li>
                    <?php if (!isset($_COOKIE['login'])): ?>
                        <li id="sign-in-button">
                            <a>
                                Войти
                                <i class='fa fa-sign-in'></i>
                            </a>
                        </li>
                    <?php else: ?>
                        <li id="sign-out-button">
                            <a href='/logout'>
                                Выйти
                                <i class='fa fa-sign-out'></i>
                            </a>
                        </li>
                    <?php endif ?>
                </ul>
            </div>
        </div>
        <div id='header-content'>
            <div id='logo'>
                <a href = "/">
                    <img src='/templates/images/logo.png'>
                </a>
            </div>
            <div id="search">
                <form id='search-form'>
                    <input type='search' placeholder='Поиск' id="search-template" name="template">
                    <button type='submit' class='search-button'>
                    <span>
                        Поиск
                    </span>
                    </button>
                </form>
            </div>

            <div class="cart">
                <?php include_once ROOT . '/application/views/CartView.php'?>
            </div>
        </div>
    </header>
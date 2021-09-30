<?php
    session_start();
    include('сonnection.php');
    $_SESSION['login'] = $_POST['login'];
    $_SESSION['password'] = $_POST['pass'];

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="default.css">
</head>
<body>
    <div class="header">
        <div class="header__logo"><img width="173" src="img/logo.svg" alt="Qwerteamcrm"></div>
        <div class="header__menu">
            <ul>
                <li><a href="index.php">ГЛАВНАЯ</a></li>
                <li><a href="about.php">О СИСТЕМЕ</a></li>
            </ul>
        </div>
        <div class="header__link">
            <a href="">Проблемы со входом?</a>
        </div>
    </div>

    <div class="login">
        <form class="login__form" method="post">
            <input required type="text" placeholder="Логин" name="login">
            <input required type="password" placeholder="Пароль" name="pass">
            <div class="error">
                <?php
                    $connect = new connection($_POST['login'], $_POST['pass']);
                    $connect ->selectlogin();
                ?>
            </div>
            <input type="submit" value="Войти">
            <a href="#">Забыли пароль?</a>
        </form>
        <img class="bgimg" src="img/ellipse.png" alt="">
    </div>
</body>
</html>
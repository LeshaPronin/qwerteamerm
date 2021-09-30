<?php
session_start();
include('сonnection.php');

$connect = new connection($_POST['login'], $_POST['pass']);
$connect->accountverification();
$connect->selectposition();
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Личный кабинет</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="default.css">
</head>
<body>
<div class="header">
    <div class="header__logo"><img width="173" src="img/logo.svg" alt="Qwerteamcrm"></div>
    <div class="header__menu">
        <ul>
            <li> <div class="caps"><?echo $GLOBALS['$name']." ".$GLOBALS['$surname']."<br><div class='position'>".$GLOBALS['$position']."</div>";?></div></li>
        </ul>
    </div>
    <div class="header__link">
        <a href="logout.php">Выйти</a>
    </div>
</div>

    <div class="tasks">
        <div class="title">
            Список задач
        </div>
        <?php
            $connect -> selectusertask();
        ?>
        <div class="list-employees__void"></div>
    </div>

</body>
</html>
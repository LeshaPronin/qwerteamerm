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
<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.5.1.min.js"></script>
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
    <div class="employees">
        <div class="title">Список сотрудников</div>
        <div class="list-employees">
            <?php
            $connect->selecttask();
            ?>
            <div class="reg">
                <a class="regbutton">+ Добавить сотрудника</a>

                <div id="popup" class="popupinput">
                    <form class="inputform" action="" method="post">
                        <input type="text" placeholder="Логин" name="insertlogin">
                        <input type="text" placeholder="Пароль" name="insertpassword">
                        <input type="text" placeholder="Имя" name="insertname">
                        <input type="text" placeholder="Фамилия" name="insertsurname">
                        <input type="text" placeholder="Возраст" name="insertage">
                        <select name="ID_position" id="">
                            <?php
                                $connect->selectpos();
                            ?>
                        </select>
                        <input type="submit" value="+ Добавить">
                    </form>
                </div>
            </div>
        </div>
        <div class="list-employees__void"></div>
    </div>

<?php
    $insert = new insert($_POST['insertlogin'], $_POST['insertpassword'], $_POST['insertname'], $_POST['insertsurname'], $_POST['insertage'], $_POST['ID_position']);
    $insert->userinsert();
?>
<script>
    jQuery(document).ready(function(){
        jQuery('.list-employees__employ-link').click(function(){
            $(this).parents('.list-employees__container').toggleClass("list-employees__hidden-active").find('.list-employees__hidden').slideToggle();
        })
    })

    jQuery(document).ready(function(){
        jQuery('.regbutton').click(function(){
            $(this).parents('.reg').toggleClass("popupinput-active").find('.popupinput').slideToggle();
        })
    })

</script>
</body>
</html>
<?php

    class connection {

        public $login;
        public $password;

        public function __construct($login, $password) {
            $this -> login = $login;
            $this -> password = $password;
        }

        public function connect() {
            $conn = mysqli_connect("localhost", "Lesha", "1111", "userbase");
            mysqli_set_charset($conn, 'utf8');
            return $conn;
        }

        public function selectlogin() {
            $connect = new connection($this -> login, $this -> password);
            $select = mysqli_query($connect ->connect(), "SELECT ID_user, login, password, name_department FROM user LEFT JOIN position ON user.ID_position = position.ID_position LEFT JOIN department ON position.ID_department = department.ID_department");
            $arr = mysqli_fetch_all($select, MYSQLI_ASSOC);
            foreach ($arr as $key => $value) {
                if ($value['login']==$this->login) {
                    if ($value['password']==$this->password) {
                        $_SESSION['logindb'] = $value['login'];
                        $_SESSION['passworddb'] = $value['password'];
                        $_SESSION['id'] = $value['ID_user'];
                        if ($value['name_department']=="Руководство") {
                            echo '<script>window.location.href = "admin.php";</script>';
                        }
                        else {
                            echo '<script>window.location.href = "user.php";</script>';
                        }
                    }
                    else {
                    }
                }

                else {
                }
            }
            if ($_SESSION['login'] == $value['login'] and $_SESSION['password'] == $value['password']) {

            }

            elseif (empty($_SESSION['login']) and empty($_SESSION['password'])){

            }

            else {
                echo "Неверно введены логин или пароль";
            }
        }

        public function accountverification() {
            if ($_SESSION['logindb'] == $_SESSION['login'] and $_SESSION['passworddb'] == $_SESSION['password']) {

            }
            else {
                echo '<script>window.location.href = "index.php";</script>';
            }
        }

        public function selectposition() {
            $connect = new connection($this -> login, $this -> password);
            $id = $_SESSION['id'];
            $select = mysqli_query($connect ->connect(), "SELECT name, surname, name_position FROM user LEFT JOIN position ON user.ID_position = position.ID_position WHERE ID_user = $id");
            $arr = mysqli_fetch_all($select, MYSQLI_ASSOC);

            $GLOBALS['$name'] = $arr[0]['name'];
            $GLOBALS['$surname']  = $arr[0]['surname'];
            $GLOBALS['$position']  = $arr[0]['name_position'];
        }

        public function selecttask() {
            $connect = new connection($this -> login, $this -> password);
            $select = mysqli_query($connect ->connect(), "SELECT ID_user, name, surname, name_position FROM user LEFT JOIN position ON user.ID_position = position.ID_position");
            $arr = mysqli_fetch_all($select, MYSQLI_ASSOC);

            foreach ($arr as $key => $value) {
                $iduser = $value['ID_user'];
                $selecttasksdone = mysqli_query($connect ->connect(), "SELECT task FROM user LEFT JOIN tasks ON user.ID_user = tasks.ID_user WHERE user.ID_user = $iduser and done=1");
                $arrtasksdone = mysqli_fetch_all($selecttasksdone, MYSQLI_ASSOC);

                $selecttasksnot = mysqli_query($connect ->connect(), "SELECT task FROM user LEFT JOIN tasks ON user.ID_user = tasks.ID_user WHERE user.ID_user = $iduser and done=0");
                $arrtasksnot = mysqli_fetch_all($selecttasksnot, MYSQLI_ASSOC);

                echo    '<div class="list-employees__container">'.
                            '<a href="#" class="list-employees__employ-link">'.
                                '<div class="list-employees__arrow"></div>'.
                                '<div class="list-employees__name">'.$value['surname'].' '.$value['name'].'</div>'.
                                '<div class="list-employees__position">'.$value['name_position'].'</div>'.
                            '</a>'.
                            '<div class="list-employees__hidden">'.
                                '<div class="list-employees__title">'.
                                '</div>'.
                                '<div class="list-employees__done">'.
                                    '<ul>'.
                                        'Выполненные задачи';
                foreach ($arrtasksdone as $keytasksdone => $valuetasksdone) {
                    echo '<li>'.'- '.$valuetasksdone['task'].'<li>';
                }
                 echo               '</ul>'.
                                '</div>'.
                                '<div class="list-employees__not">'.
                                    '<ul>'.
                                        'Не выполненные задачи';
                foreach ($arrtasksnot as $keytasksnot => $valuetasksnot) {
                    echo '<li>'.'- '.$valuetasksnot['task'].'</li>';
                }
                 echo                   '</ul>'.
                                '</div>'.
                            '</div>'.
                        '</div>';
            }
        }

        public function selectpos() {
            $connect = new connection($this -> login, $this -> password);
            $selectpos = mysqli_query($connect ->connect(), "SELECT ID_position, name_position FROM position");
            $arrpos = mysqli_fetch_all($selectpos, MYSQLI_ASSOC);

            foreach ($arrpos as $keypos => $valuepos) {
                echo    '<option value="'.$valuepos[ID_position].'">'.$valuepos[name_position].'</option>';
            }
        }

        public function selectusertask() {
            $connect = new connection($this -> login, $this -> password);
            $id = $_SESSION['id'];
            $selectusertaskdone  = mysqli_query($connect ->connect(), "SELECT task FROM user LEFT JOIN tasks ON user.ID_user = tasks.ID_user WHERE user.ID_user = $id and done=1");
            $arrusertaskdone  = mysqli_fetch_all($selectusertaskdone , MYSQLI_ASSOC);

            echo    '<div class="done">'.
                        'Выполненные'.
                        '<ul>';
            foreach ($arrusertaskdone as $keytasksdone => $valuetasksdone) {
                echo '<li>'.'- '.$valuetasksdone['task'].'<li>';
            }
            echo        '</ul>'.
                    '</div>';

            $selectusertasknot  = mysqli_query($connect ->connect(), "SELECT task FROM user LEFT JOIN tasks ON user.ID_user = tasks.ID_user WHERE user.ID_user = $id and done=0");
            $arrusertasknot  = mysqli_fetch_all($selectusertasknot , MYSQLI_ASSOC);

            echo    '<div class="not">'.
                        'Не выполненные'.
                        '<ul>';
            foreach ($arrusertasknot as $keytasksnot => $valuetasksnot) {
                echo '<li>'.'- '.$valuetasksnot['task'].'<li>';
            }
            echo        '</ul>'.
                    '</div>';
        }

    }

    class insert {
        public $userlogin;
        public $userpassword;
        public $username;
        public $usersurname;
        public $userage;
        public $userposition;

        public function __construct($userlogin, $userpassword, $username, $usersurname, $userage, $userposition) {
            $this -> userlogin = $userlogin;
            $this -> userpassword = $userpassword;
            $this -> username = $username;
            $this -> usersurname = $usersurname;
            $this -> userage = $userage;
            $this -> userposition = $userposition;

        }

        public function userinsert() {
            $userlogin = $this -> userlogin;
            $userpassword = $this -> userpassword;
            $username = $this -> username;
            $usersurname = $this -> usersurname;
            $userage = $this -> userage;
            $userposition = $this -> userposition;

            $connect = new connection($this -> login, $this -> password);
            $insert = mysqli_query($connect ->connect(), "INSERT INTO `user`(`login`, `password`, `name`, `surname`, `age`, `ID_position`) VALUES ('$userlogin', '$userpassword', '$username', '$usersurname', '$userage', '$userposition')");

        }
    }
?>
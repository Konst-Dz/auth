<?php

//коннект
include "link.php";

//проверка авторизован или нет
if(empty($_SESSION['auth'])) {
    //вывод над каждым инпутом
    $isLogin = '';
    $isPass = '';
    $isEmail = '';
    $isDate = '';

    //проверка на заполнение
    if (!empty($_POST['user']) and !empty($_POST['password']) and !empty($_POST['birthday']) and !empty(
        $_POST['email'])) {

        $login = $_POST['user'];
        /*//хэш
        $password = md5($_POST['password']);*/
        /*//соль
        $salt = generateSalt();
        $password = md5($salt . $_POST['password']);*/
        //хэш с солью
        $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $country = $_POST['country'];


        //проверка на соотв. пароля
        if ($_POST['password'] == $_POST['confirm']) {
            //длина пароля
            $passwordC = strlen($_POST['password']);

            //проверка длины
            if ($passwordC > 5 and $passwordC < 13) {

                //проверка на минимум
                if (preg_match('#^[a-z0-9]{3,}$#i', $login) == 1) {

                    //проверка емайла
                    if (preg_match('#^[a-z0-9_-]+@[a-z0-9]+\.[a-z]{2,3}$#i', $email)) {

                        //проверка даты д-м-г
                        if (preg_match('#^([0-2][0-9])|(3[01])\.(0[0-9])|(1[12])\.(19[0-9]{2})|(20[0-2][0-9])$#', $birthday)) {

                            //запрос на логин в БД
                            $query = "SELECT * FROM user WHERE user = '$login' ";
                            $data = mysqli_query($connect, $query) or die(mysqli_error($connect));
                            $user = mysqli_fetch_assoc($data);
                            var_dump($user);

                            if (!$user) {
                                var_dump($_REQUEST);
                                //запись в БД
                                $query = "INSERT INTO user SET user = '$login',password = '$password', birthday = '$birthday',
date = NOW() ,email = '$email',id_country = '$country',id_status = 1 /*,salt = '$salt'*/ ";
                                mysqli_query($connect, $query) or die(mysqli_error($connect));

                                //немедленная авторизация
                                $_SESSION['auth'] = true;
                                //запрос на ид и запись в сессию
                                $id = mysqli_insert_id($connect);
                                $_SESSION['id'] = $id;
                                //статус юзер
                                $_SESSION['status'] = 1;
                                //header('Location:auth/');

                            } else {
                                $isLogin = "<p class=\"error\">Логин занят.</p>";
                            }


                        } else {
                            $isDate = "\"<p class=\"error\">Формат даты должен быть дд-мм-гггг.</p>";
                        }

                    } else {
                        $isEmail = "<p class=\"error\">Некорректный ввод e-mail.</p>";
                    }


                } else {
                    $isLogin = "<p class=\"error\">Некорректный логин.</p>";
                }


            }//длина
            else {
                $isPass = "<p class=\"error\">Пароль должен быть не менее 6 символов и не более 12.</p>";
            }

        } else {
            $isPass = "<p class=\"error\">Введенные пароли не совпадают.</p>";
        }

    }
}
else{ echo "<p><a href=\"logout.php\">Logout</a></p>";
}
/*//соль
function generateSalt(){
    $salt = '';
    for ($i=1;$i<=8;$i++){
        $salt .=  chr(mt_rand(33,126));
    }
    return $salt;
}*/

$content = '';
$content .= "<form method=\"POST\" action=\"\">";
$content .= $isLogin;
$content .= "<input type=\"text\" name=\"user\"> Login<br><br>";
$content .= $isPass;
$content .= "<input type=\"password\" name=\"password\"> Password<br><br>";
$content .= "<input type=\"password\" name=\"confirm\"> Confirm Password<br> <br>";
$content .= $isEmail;
$content .= "<input type=\"text\" name=\"email\"> email<br><br>";
$content .= $isDate;
$content .= "<input type=\"text\" name=\"birthday\"> birthday<br><br>";
include "folder/select.php ";
$content .= selectCountry($connect);
$content .= "<input type=\"submit\" ><br></form>";

include "folder/layout.php";
?>
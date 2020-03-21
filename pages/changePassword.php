<?php

include '../link.php';
// ид передаем сессией а не запросом
$id = $_SESSION['id'];

$query = "SELECT password FROM user WHERE id = '$id' ";
$data = mysqli_query($connect, $query) or die(mysqli_error($connect));
$user = mysqli_fetch_assoc($data);

if (!empty($_POST['oldPass']) and !empty($_POST['newPass']) and !empty($_POST['confirm'])) {

    $oldPass = $_POST['oldPass'];
    $newPass = $_POST['newPass'];
    $confirm = $_POST['confirm'];
    $hash = $user['password'];

    //проверка пароля
    if (password_verify($oldPass,$hash)){

        if ($newPass == $confirm){

            $newPass = password_hash($newPass,PASSWORD_DEFAULT);
            $query = "UPDATE user SET password = '$newPass' WHERE id ='$id' ";
            $data = mysqli_query($connect, $query) or die(mysqli_error($connect));

            $_SESSION['message'] = ['text' => 'Пароль изменен успешно'];

        }
        else{
            echo "Введеные пароли не совпадают";
        }

    }
    else{
        echo "Пароль не верен";
    }
}

if ($_SESSION['auth']) {

    $content .= "<form method=\"POST\" action=\"\" >";
    $content .= "<input type=\"text\" value=\"{$user['user']}\" disabled >Логин<br>";
    $content .= "<input type=\"password\" value=\"{$user['email']}\" name=\"oldPass\" >Старый пароль<br>";
    $content .= "<input type=\"password\" value=\"{$user['email']}\" name=\"newPass\" >Новый пароль<br>";
    $content .= "<input type=\"password\" value=\"{$user['email']}\" name=\"confirm\" >Подтверждение<br>";
    $content .= "<input type=\"submit\" value=\"Редактировать\">";
    $content .= "</form>";
}
else{
    $content = "Вы не авторизованы <br> <a href=\"../login.php\">Login</a>";
}
include "../folder/layout.php";
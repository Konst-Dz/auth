<?php
include '../link.php';
// ид передаем сессией а не запросом
$id = $_SESSION['id'];

$query = "SELECT user,password FROM user WHERE id = '$id' ";
$data = mysqli_query($connect, $query) or die(mysqli_error($connect));
$user = mysqli_fetch_assoc($data);

if (!empty($_POST['password'])) {

    $password = $_POST['password'];
    $hash = $user['password'];

    //проверка пароля
    if (password_verify($password,$hash)){

            $newPass = password_hash($newPass,PASSWORD_DEFAULT);
            $query = "DELETE FROM user WHERE id ='$id' ";
            $data = mysqli_query($connect, $query) or die(mysqli_error($connect));

            $_SESSION['message'] = ['text' => 'Аккаунт удален'];
            $_SESSION['auth'] = null;

    }
    else{
        echo "Пароль не верен";
    }
}

if ($_SESSION['auth']) {

    $content .= "<form method=\"POST\" action=\"\" >";
    $content .= "<input type=\"text\" value=\"{$user['user']}\" disabled >Логин<br>";
    $content .= "<input type=\"password\" name=\"password\" >Ваш пароль<br>";
    $content .= "<input type=\"submit\" value=\"Удалить\">";
    $content .= "</form>";
}
else{
    $content = "Вы не авторизованы <br> <a href=\"../login.php\">Login</a>";
}
include "../folder/layout.php";
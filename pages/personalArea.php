<?php

include "../link.php";

if ($_SESSION['auth']) {

    // ид передаем сессией а не запросом
    $id = $_SESSION['id'];

    if (!empty($_POST['email']) and !empty($_POST['birthday']) and !empty($_POST['country'])) {

        $email = $_POST['email'];
        $birthday = $_POST['birthday'];
        $country = $_POST['country'];

        $query = "UPDATE user SET email = '$email',birthday = '$birthday',id_country = '$country'  WHERE id ='$id' ";
        $data = mysqli_query($connect, $query) or die(mysqli_error($connect));

    }

    $query = "SELECT * FROM user WHERE id = '$id' ";
    $data = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $user = mysqli_fetch_assoc($data);

    if ($user) {

        $content = '';
        $content .= "<a href=\"changePassword.php?id_user=$id\">Сменить пароль</a>";
        $content .= "<form method=\"POST\" action=\"\" >";
        $content .= "<input type=\"text\" value=\"{$user['user']}\" disabled >Логин<br>";
        $content .= "<input type=\"text\" value=\"{$user['email']}\" name=\"email\" >Email<br>";
        $content .= "<input type=\"text\" value=\"{$user['birthday']}\" name=\"birthday\" >Дата рождения<br>";
        include "../folder/select.php";
        $content .= selectCountry($connect);
        $content .= "<input type=\"submit\" value=\"Редактировать\">";
        $content .= "</form>";


    }

}
else{
    $content = "Вы не авторизованы<br><a href=\"../login.php\">Login</a>";
}
include "../folder/layout.php";
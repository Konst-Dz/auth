<?php

include "../link.php";

if (isset($_GET['id'])){

$id = $_GET['id'];

$query = "SELECT user,date,birthday,country.name FROM user LEFT JOIN country ON user.id_country = country.id WHERE user.id = '$id' ";
$data = mysqli_query($connect, $query) or die(mysqli_error($connect));
$user = mysqli_fetch_assoc($data);


    if($user) {
        $age = $user['birthday'];
        
        $content = '';
        $content .= "<table>";
        $content .= "<tr><td>Логин:</td><td>{$user['user']}</td></tr>";
        $content .= "<tr><td>Страна:</td><td>{$user['name']}</td></tr>";
        $content .= "<tr><td>Возраст:</td><td>{$user['birthday']}</td></tr>";
        $content .= "<tr><td>Дата регистрации:</td><td>{$user['date']}</td></tr>";
        $content .= "</table>";
    }
}

include "../folder/layout.php";
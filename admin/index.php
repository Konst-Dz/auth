<?php

include "../link.php";
//админ
if (isset($_SESSION['auth']) and $_SESSION['status'] == 2){

        if(isset($_GET['change']) and isset($_GET['user'])){
            $status = $_GET['change'];
            $login = $_GET['user'];
            $query = "UPDATE user SET id_status = '$status' WHERE user = '$login' ";
            $data = mysqli_query($connect, $query) or die(mysqli_error($connect));
        }
        //delete
        if(isset($_GET['del_user'])){
            $login = $_GET['del_user'];
            $query = "DELETE FROM user WHERE user = '$login' ";
            $data = mysqli_query($connect, $query) or die(mysqli_error($connect));
        }


    $id = $_SESSION['id'];
    //кроме себя
    $query = "SELECT user,status FROM user LEFT JOIN status ON user.id_status = status.id WHERE user.id != '$id' ";
    $data = mysqli_query($connect, $query) or die(mysqli_error($connect));
    for($arr = [];$row = mysqli_fetch_assoc($data);$arr[] = $row);

    //таблица
    $content = '';
    $content .= "<table>";
    $content .= "<tr><th>Логин:</th><th>Cтатус</th><th>Изменение</th><th>Удаление</th></tr>";
    foreach ($arr as $item) {
        $login = $item['user'];
        if ($item['status'] == 'admin'){
            $change = "Сделать юзером";
            $num = 1;
            $row = 'adminRow';
        }
        else{
            $change = "Сделать админом";
            $num = 2;
            $row = 'userRow';
        }

        $content .= "<tr class=\"$row\"><td>$login</td><td>{$item['status']}</td>
<td><a href=\"?change=$num&user=$login\">$change</a></td><td><a href=\"?del_user=$login\">Удалить</a></td></tr>";
    }
    $content .= "</table>";

}
else{
    $content = "page not found";
}

include "../folder/layout.php";
<?php

include "link.php";

if ($_SESSION['auth']) {
    echo "<p><a href=\"logout.php\">Logout</a></p>";

    if (!empty($_POST['login']) and !empty($_POST['password'])) {
        $login = $_POST['login'];
        $password = $_POST['password'];

        //селект по логину
        $query = "SELECT * FROM user WHERE user = '$login' ";
        $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
        $user = mysqli_fetch_assoc($result);

        //проверка логина
        if (!empty($user)) {
            /*//соль из БД , пароль юзера и пароль из БД
            $salt = $user['salt'];
            $userPass = md5($salt . $password);
            $bdPass = $user['password'];*/
            $hash = $user['password'];
            //проверка хешей
            if (password_verify($_POST['password'],$hash)) {

                $_SESSION['auth'] = true;
                $_SESSION['id'] = $user['id'];
            } else {
                echo "Wrong login or password";
            }

        } else {
            echo "Wrong login or password";
        }
    }

}
else{
    ?>
    <form method="POST">
        <input type="text" name="login">Login <br>
        <input type="password" name="password" id="">Password <br>
        <input type="submit"><br>
    </form>
    <?php

}

?>


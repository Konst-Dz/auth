<?php

if($_SESSION['auth']){
    $id = $_SESSION['id'];
    echo "<a href=\"../pages/users.php\">Users</a>";
    echo "<a href=\"../pages/personalArea.php?id_user=$id\">Profile</a>";
    echo "<a href=\"../logout.php\">Logout</a>";
}
else{
    echo  "<a href=\"../login.php\">Login</a>";
}
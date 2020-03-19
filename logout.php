<?php
include "link.php";
$_SESSION['auth'] = null;
$_SESSION['message'] = ['text' =>'you have been logout'];
$info = $_SESSION['message']['text'];
echo $info;
//header('Location:login.php');die();
?>
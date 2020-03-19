<?php

include "../link.php";

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $query = "SELECT * FROM user WHERE id = '$id' ";
    $data = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $user = mysqli_fetch_assoc($data);

    if($user){

    }
}
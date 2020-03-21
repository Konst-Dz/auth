<?php
session_start();
if(isset($_SESSION['message'])){

    $text = $_SESSION['message']['text'];
    echo "<p>$text</p>";
    unset($_SESSION['message']['text']);

}
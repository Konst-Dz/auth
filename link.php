<?php
session_start();
$host='localhost';
$login='root';
$pass='';
$dbName='auth';
$connect = mysqli_connect($host,$login,$pass,$dbName) or die(mysqli_error($connect));
mysqli_query($connect,'SET NAMES utf8');

<?php

include "../link.php";

$query = "SELECT id,user FROM user  ";
$data = mysqli_query($connect, $query) or die(mysqli_error($connect));
for ($arr = [];$row = mysqli_fetch_assoc($data);$arr[] = $row);

$content = '';
foreach ($arr as $item) {
    $content .= "<a href=\"profile.php?id={$item['id']}\">{$item['user']}</a><br><br>";
}

include "../folder/layout.php";
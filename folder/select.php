<?php
function selectCountry($connect)
{
    $select = '';
    $select .= "<select name=\"country\">";

    $query = "SELECT * FROM country";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    for ($arr = []; $row = mysqli_fetch_assoc($result); $arr[] = $row) ;

    foreach ($arr as $item) {
        $select .= "<option value=\"{$item['id']}\">{$item['name']}</option>";
    }
    $select .= "</select><br><br>";
    return $select;
}
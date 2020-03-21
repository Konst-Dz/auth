<!doctype html>
<html lang="ru">
<head>
    <link rel="stylesheet" href="/folder/style.css">
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<header>
    <?php
    include "header.php";
    ?>
</header>
<main>
    <?php include 'info.php'; ?>
<?= $content ?>
</main>
</body>
</html>
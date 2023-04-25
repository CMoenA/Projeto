<?php
//session_start(); sempre no inicio para ligar a SESSION
//SESSION é como se fosse um cofre onde guarda as variaveis que define uma coneção
//Por defenição a sessão é finalizada quando se fecha o browser.
session_start();

?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
</head>

<body>
    <?php
    session_unset();
    session_destroy();
    header("refresh:0;url=index.php");
    ?>
</body>

</html>
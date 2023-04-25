<?php
//session_start(); sempre no inicio para ligar a SESSION
//SESSION é como se fosse um cofre onde guarda as variaveis que define uma coneção
//Por defenição a sessão é finalizada quando se fecha o browser.
session_start();
?>
<!doctype html>
<html lang="en">
<body>


    <?php
    //if (isset($_POST['username'])) {
    //    echo "O username submetido foi:" . $_POST['username'] . "<br>";
    //}

    //if (isset($_POST['password'])) {
    //    echo "A password submetido foi:" . $_POST['password'] . "<br>";
    //}

    //variável PHP para definir um utilizador válido:
    //busca o username da tag username do email adress
    //echo "o Usernarme 1: " . $username;
    //qualquer email será aceito.
    $username = $_POST['username'];


    //para ver ver e depois copiar o hash da password:
    //echo password_hash($_POST['password'], PASSWORD_DEFAULT);
    //utilize plicas ('') e não aspas ("") para guardar a hash na variável
    $password_hash = '$2y$10$lFveS95WXmz1qY1cv5u09eSdFVBWcg22KDmhcTGpPDY8y.0jkh7Py';
    $password_hash = '$2y$10$EH6eVpRDz2mSSQU2cRk1guyFGFXqt5VhsYD9VbwOOZ6EMPNjpzDUG';
    $password_hash = '$2y$10$FRXYu/ulXe3gYi1CefWcwuv1xmcE/.N4wHpxEVSyDE7Pee4wSE2Vq';
    $password_hash = '$2y$10$6vTUi9BgduVdaRuIzCdvJ.e/XvzkJg/tRg41.NOC5hfihUGU5iRLq';
    

    ?>
    </body>
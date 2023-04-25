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
    //if (isset($_POST['username'])) {
    //    echo "O username submetido foi:" . $_POST['username'] . "<br>";
    //}

    //if (isset($_POST['password'])) {
    //    echo "A password submetido foi:" . $_POST['password'] . "<br>";
    //}

    //variável PHP para definir um utilizador válido:
    //busca o username da tag username do email adress
    $username = $_POST['username'];
    //echo "o Usernarme 1: " . $username;

    //para ver ver e depois copiar o hash da password:
    //echo password_hash($_POST['password'], PASSWORD_DEFAULT);
    //utilize plicas ('') e não aspas ("") para guardar a hash na variável
    $password_hash = '$2y$10$qvtQWpTCWsRXpGTSskojGOHTw0rwIomZmDJtJLMVFYWKBVFeskh5G';


    //Lab04.Ex.16 
    //estrutura de decisão (if…else) para confirmar que os dados que 
    //recebe via POST são iguais aos das credenciais que definiu no exercício anterior. 
    if (password_verify($_POST['password'], $password_hash)) {
        echo 'Password is valid!';
        $_SESSION["username"] = $username;
        //echo "\n Sessao username: " . $_SESSION["username"];
        header("refresh:0.7;url=dashboard.php");
    } else if ($_POST['password'] == null) {
        echo "Introduza as suas credenciais.<br>";
    } else {
        echo "Invalid password.";
    }


    ?>


    <div class="container">

        <div class="row  justify-content-center align-items-center">
            <form class="TIform" action="" method="post">

                <a class="navbar-brand" href="index.php"><img src="files/estg_h.png" hr></a>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input name="username" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text"></div>
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submeter</button>
            </form>

        </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
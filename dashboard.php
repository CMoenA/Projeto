<?php
//"Notice that session variables are not passed individually to each new page, 
//instead they are retrieved from the session we open at the beginning of each
// page (session_start())." (https://www.w3schools.com/php/php_sessions.asp)
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Plataforma IoT</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css" />
    <meta http-equiv="refresh" content="1">
</head>

<body>
    <?php

    //iniciar a sessoao
    //se a variavel sessao que guarda o username não foi iniciada entao{
    //atauliza a pagina e redireciona para a pagina index.php 
    //}

    //As variáveis de sessão permitem guardar variáveis em
    //memória no browser para poderem ser utilizadas em múltiplas
    //páginas. Estas variáveis ficam disponíveis até serem apagadas
    //ou até o browser fechar.

    //Para serem utilizadas estas variáveis de sessão, o servidor deve
    //informar o browser que vai usá-las. Isso é feito através da
    //inserção na primeira linha de código PHP:

    //echo "\n Dash. Sessao username: " . $_SESSION["username"];
    if (!isset($_SESSION['username'])) {
        header("refresh:5;url=index.php");
        //header() is used to send a raw HTTP header.
        die("Acesso restrito.");
    } else {
        $username = $_SESSION["username"];
    }

    $valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
    $hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");
    $nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");


    //echo $nome_temperatura . ": " . $valor_temperatura . "ºC em " . $hora_temperatura;

    ?>

    <!--navbar é a barra de navegação, onde se encontra o nome da pagina que esta dentro da pagina, o nome do separador fica no header.
    encontra-se tambem:  opção Home, Historico e o botão Logout-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Painel - Utilizador <b><?php echo $username ?></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Historico</a>
                    </li>
                </ul>

                <!--ao selecioar Logout, é redirecionado para a pagina logout,
                onde é terminado a sessão do utilizador e redirecionado para a pagina index-->
                <a href="logout.php"><button type="button" class="btn btn-outline-dark" href="logout.php">Logout</button></a>

            </div>
        </div>
    </nav>

    <!-- Topo da pagina -->
    <div class="container rounded text-center">
        <img class="bg-image2" src="imagens/banner_estg_2.png">
        <h1 class=" card-title">Controlo de ambiente da ESTG</h1>
    </div>

    <!-- Conteudo -->
    <!-- Temperatura e Ar Condicionado -->
    <div class="container rounded text-center" id="menuPainel">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <!--O valor da temperatura é dinamico, porque utiliza uma variavel php-->
                    <div class="card-header sensor">
                        <image src="imagens/thermometer-low.svg" /></i> Temperatura:
                    </div>
                    <div class="card-body">
                        <p><?php echo $valor_temperatura ?>ºC</p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header sensor">Ar Condicionado:</div>
                    <div class="card-body">
                        <p>Ligado/Desligado<?php echo $valor_arcondicionado ?></p>
                    </div>
                </div>
            </div>
            <p>Atualização: <?php echo $hora_temperatura ?> - <a href="#">Histórico</a></p>
        </div>
    </div>


    <!-- Qualidade do ar e aviso para abrir a janela -->
    <div class="container rounded text-center" id="menuPainel">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <!--O valor da temperatura é dinamico, porque utiliza uma variavel php-->
                    <div class="card-header sensor">Nivel de dioxido de carbono:</div>
                    <div class="card-body">
                        Boa/Baixa<?php echo $qualidade_do_ar ?>
                    </div>

                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header sensor">Aviso Para Abrir a Janela:</div>
                    <div class="card-body">
                        Ligado/Desligado<?php echo $qualidade_do_ar ?>
                    </div>
                </div>
            </div>
            <p>Atualização: <?php echo $hora_temperatura ?> - <a href="#">Histórico</a></p>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <footer style="
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;
    background: #ebebe0;
    border-bottom:3px solid  #c2c2a3;
    ">
        <img src="imagens/estg_h-01.png" alt="logo da estg" style="max-height: 50px;">
    </footer>
</body>

</html>
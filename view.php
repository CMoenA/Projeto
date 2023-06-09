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
    <!--<meta http-equiv="refresh" content="1">-->
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
    $valor_temperatura = file_get_contents("api/files/temperatura/valor.txt");
    $hora_temperatura = file_get_contents("api/files/temperatura/hora.txt");
    $nome_temperatura = file_get_contents("api/files/temperatura/nome.txt");

    $valor_humidade = file_get_contents("api/files/humidade/valor.txt");
    $hora_humidade = file_get_contents("api/files/humidade/hora.txt");

    if (isset($_POST['valor']) && isset($_POST['hora']) && isset($_POST['nome'])) {

        file_put_contents("files/" . $_POST['nome'] . "/valor.txt", $_POST['valor']);
        file_put_contents("files/" . $_POST['nome'] . "/hora.txt", $_POST['hora']);
        file_put_contents("files/" . $_POST['nome'] . "/log.txt", $_POST['hora'] . "; " . $_POST['valor'] . PHP_EOL, FILE_APPEND);
    }


    //echo $nome_temperatura . ": " . $valor_temperatura . "ºC em " . $hora_temperatura;

    ?>

    <!--navbar é a barra de navegação, onde se encontra o nome da pagina que esta dentro da pagina, o nome do separador fica no header.
    encontra-se tambem:  opção Home, Historico e o botão Logout-->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#"><b>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                </ul>

                <!--ao selecioar Logout, é redirecionado para a pagina logout,
                onde é terminado a sessão do utilizador e redirecionado para a pagina index-->
                <a href="login.php"><button type="button" class="btn btn-outline-dark" href="logout.php">Login</button></a>

            </div>
        </div>
    </nav>

    <!-- Topo da pagina -->
    <div class="container rounded text-center">
        <img class="bg-image2" src="imagens/banner_estg_2.png">
        <h1 class="titulo">Controlo de ambiente da ESTG</h1>
    </div>

    <!-- Conteudo -->
    <!-- Temperatura e Ar Condicionado -->
    <div class="container rounded text-center" id="menuPainel">
        <div class="row">
            <p> Fora do Edificio </p>
            <div class="col-sm-6">
                <div class="card">
                    <!--O valor da temperatura é dinamico, porque utiliza uma variavel php-->
                    <div class="card-header sensor">
                        <image src="imagens/thermometer-low.svg" /></i> Temperatura:
                    </div>
                    <div class="card-body">
                        <p><?php echo $valor_temperatura ?>ºC</p>
                    </div>
                    <div class="card-footer">
                        <p>Atualização: <?php echo $hora_temperatura ?><br><a class="link" href="#"><button type="button" class="btn btn-outline-secondary">Histórico</button></a></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header atuador">Humidade:</div>
                    <div class="card-body">
                        <p>40<?php echo $valor_humidade ?>%</p>
                    </div>
                    <div class="card-footer">
                        <p>Atualização: <?php echo $hora_temperatura ?><br><a class="link" href="#"><button type="button" class="btn btn-outline-secondary">Histórico</button></a></p>
                    </div>
                </div>

            </div>

        </div>
    </div>


    <!-- Qualidade do ar e aviso para abrir a janela -->
    <div class="container rounded text-center" id="menuPainel">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <!--O valor da temperatura é dinamico, porque utiliza uma variavel php-->
                    <div class="card-header sensor">Nivel de Dioxido de Carbono:</div>
                    <div class="card-body">
                        Ligada/Desligada<?php echo $estado_luz ?>
                    </div>
                    <div class="card-footer">
                        <p>Atualização: <?php echo $hora_temperatura ?><br><a class="link" href="#"><button type="button" class="btn btn-outline-secondary">Histórico</button></a></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header sensor">Aviso Para Abrir a Janela:</div>
                    <div class="card-body">
                        Ligado/Desligado<?php echo $qualidade_do_ar ?>
                    </div>
                    <div class="card-footer">
                        <p>Atualização: <?php echo $hora_temperatura ?><br><a class="link" href="#"><button type="button" class="btn btn-outline-secondary">Histórico</button></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Luz -->
    <div class="container rounded text-center" id="menuPainel">
        <div class="row">
            <div class="col-sm-6">
                <div class="card">
                    <!--O valor da temperatura é dinamico, porque utiliza uma variavel php-->
                    <div class="card-header sensor">Luz:</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-secondary">Ligado/Desligado<?php echo $qualidade_do_ar ?></button></a></p>
                    </div>
                    <div class="card-footer">
                        <p>Atualização: <?php echo $hora_temperatura ?><br><a class="link" href="#"><button type="button" class="btn btn-outline-secondary">Histórico</button></a></p>
                    </div>
                </div>
            </div>

            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header sensor">Eletricidade:</div>
                    <div class="card-body">
                        <button type="button" class="btn btn-outline-secondary">Ligado/Desligado<?php echo $qualidade_do_ar ?></button></a></p>
                    </div>
                    <div class="card-footer">
                        <p>Atualização: <?php echo $hora_temperatura ?><br><a class="link" href="#"><button type="button" class="btn btn-outline-secondary">Histórico</button></a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <footer>
        <img src="imagens/estg_h-01.png" alt="logo da estg" style="max-height: 50px;">
    </footer>
</body>

</html>
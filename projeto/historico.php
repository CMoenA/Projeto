<?php
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
    //echo "\n Dash. Sessao username: " . $_SESSION["username"];
    if (!isset($_SESSION['username'])) {
        header("refresh:5;url=index.php");
        //header() is used to send a raw HTTP header.
        die("Acesso restrito.");
    } else {
        $username = $_SESSION["username"];
    }

    $msgValorNaoEncontrado = "Value not Found!";



    //pedir todos os logs
    $temperature_log = json_decode(file_get_contents("http://127.0.0.1/projeto/api/api.php?name=temperature&log=s"), true);
    $humidity_log = json_decode(file_get_contents("http://127.0.0.1/projeto/api/api.php?name=humidity&log=s"), true);
    $dioxideCarbonLevel_log = json_decode(file_get_contents("http://127.0.0.1/projeto/api/api.php?name=dioxideCarbonLevel&log=s"), true);
    $warningOpenWindow_log = json_decode(file_get_contents("http://127.0.0.1/projeto/api/api.php?name=warningOpenWindow&log=s"), true);
    $light_log = json_decode(file_get_contents("http://127.0.0.1/projeto/api/api.php?name=light&log=s"), true);
    $electricity_log = json_decode(file_get_contents("http://127.0.0.1/projeto/api/api.php?name=electricity&log=s"), true);

    if (!isset($temperature_log)) {
        $erro0 = true;
        echo '<style type="text/css">#menuPainel {display: none;}</style>';
    }


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
                        <a class="nav-link active" aria-current="page" href="dashboard.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"> Historico</a>
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
        <h1 class="titulo">
            <?php if ($erro0) {
                //$erro0 -> boolean, verdade se logName não existir
                echo 'Não encontramos o que procura';
            } else {
                echo 'Historico ' . $logName; //todo
            }  ?>
        </h1>
    </div>



    <!-- Conteudo -->
    <!-- Temperatura Log/Historico -->
    <div class="container rounded text-center" id="menuPainel">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <!--Cabeçalho do card-->
                    <div class="card-header table">
                        <select name="logNameselect" id="logNameselect">
                            <option value="$temperature_log">Temperatura</option>
                            <option value="humidity_log">Humidade</option>
                            <option value="dioxideCarbonLevel_log">Nivel de Dioxido de Carbono</option>
                            <option value="warningOpenWindow_log">Aviso Para Abrir a Janela</option>
                            <option value="light_log">Luz</option>
                            <option value="electricity_log">Eletricidade</option>
                        </select>
                    </div>
                    <!--Body do card-->
                    <div class="card-body">
                        <!-- Valores Log/Historico-->
                        <p>
                            <?php
                            // var_dump($temperature_log);

                            // echo JSON_PRETTY_PRINT($temperature_log);
                            //echo $temperature_log->hour[0];
                            //echo $temperature_log->hour;
                            //echo $temperature_log->log->hour;
                            //echo $temperature_log->log->hour[0];

                            //uma forma de descobrir como chamar os valores é usar o var_dump($temperature_log); 
                            //e depois adicionar um [] por cada [] depois do nome da variavel. $nomedavariavel[][][]...
                            //neste caso fica echo $nome['log'][1]['hour'] isto apresentaria o valor  2023/04/26 21:32
                            /*
                            array(1) {
                                ["log"]=> array(2) {
                                        [0]=> array(2) {["value"]=> string(2) "25"
                                        ["hour"]=> string(16) "2023/04/26 21:32"
                                    }
                                    [1]=> array(2) {
                                        ["value"]=> string(2) "25"
                                        ["hour"]=> string(16) "2023/04/26 21:32"
                                    }
                                }
                            }
                            */
                            //echo "Date and time: " . $temperature_log['log'][0]['hour'] . " Value: " . $temperature_log['log'][0]['value'];

                            //echo var_dump($temperature_log);

                            echo '<table style="width:100%">'; //criar uma tabela
                            echo '<tr>'; //cria a primeira linha da tabela
                            echo '<th>Hour</th>'; //cria a primeira coluna 
                            echo '<th>Value</th>'; //cria a segunda coluna 
                            /*
                            se não for possivel encontrar facilmente o numero de arrays, fica da seguinte forma
                            $i = 0;
                            while ($temperature_log['log'][$i] != null) {
                                $i++;
                                echo "<tr><td>" . $temperature_log['log'][$i]['hour'] . "</td><td>" . $temperature_log['log'][$i]['value'] . '</td></tr>';
                            }
                            */
                            $max = sizeof($temperature_log['log']) - 1; //obter o numero de arrays que o array log tem
                            for ($x = 0; $x <= $max; $x++) { // percorrer os arrays
                                //percorre os arrays criando novas linhas <tr></tr> e colunas entre elas <td></td> e imprime os respetivos valor em cada uma
                                echo "<tr><td>" . $temperature_log['log'][$x]['hour'] . "</td><td>" . $temperature_log['log'][$x]['value'] . '</td></tr>';
                            }
                            echo '</table>';
                            ?>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- final-->



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <footer>
        <img src="imagens/estg_h-01.png" alt="logo da estg" style="max-height: 50px;">
    </footer>
</body>

</html>
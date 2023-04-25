<?php

//"header(string $header, bool $replace = true, int $response_code = 0): void"
//"header é usado para enviar raw HTTP 
//https://www.php.net/manual/en/function.header.php
header('Content-Type: text/html; charset=utf-8');
$data_hora = date("Y/m/d H:i");

//echo $_SERVER['REQUEST_METHOD'];

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "recebi um POST ";
    //print_r($_POST);
    //escrever para um ficheiro a variavel valor do $_POST
    if (isset($_POST['valor'])) {
        echo file_put_contents("files/temperatura/valor.txt", $_POST['valor']);
    }
    if (isset($_POST['hora'])) {
        echo file_put_contents("files/temperatura/hora.txt", $_POST['hora']);
    }
    if (isset($_POST['nome'])) {
        echo file_put_contents("files/temperatura/nome.txt", $_POST['nome']);
    }
    if (isset($_POST['nome'])) {
        echo file_put_contents("files/temperatura/log.txt", "\n" . $data_hora . "; " . $_POST['valor'], FILE_APPEND);
    }
    echo " valor : " . $_POST['valor'] . " Data e hora: " . $_POST['hora']; //para ver cada variavel, neste caso é apresentado o valor da variavel valor
    echo $_POST['hora'];
    var_dump(file_get_contents("php://input"));

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (isset($_GET['nome'])) {
            $$valor = file_get_contents($_GET['nome'] . '.txt');
            echo $valor;
        } else {
            echo "Faltam parâmetros no GET.";
        }
    }
} elseif ($_SERVER['REQUEST_METHOD'] == "GET") {
    echo "recebi um GET";
} else {
    echo "metodo nao permitido";
}

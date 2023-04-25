<?php

//"header(string $header, bool $replace = true, int $response_code = 0): void"
//"header é usado para enviar raw HTTP 
//https://www.php.net/manual/en/function.header.php
header('Content-Type: text/html; charset=utf-8');
$data_hora = date("Y/m/d H:i");

//echo $_SERVER['REQUEST_METHOD'];

//receber temperatura
//receber estado do ar condicionado

//receber nivel de dioxido de carbono
//receber estado Aviso luminoso Janela

//Receber 

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    echo "recebi um POST ";
    //print_r($_POST);//ver os valores, para confirmar se esta tudo bem.
    //escrever para um ficheiro a variavel valor do $_POST
    if (isset($_POST['valor']) && isset($_POST['hora']) && isset($_POST['nome'])) {

        file_put_contents("files/" . $_POST['nome'] . "/valor.txt", $_POST['valor']);
        file_put_contents("files/" . $_POST['nome'] . "/hora.txt", $_POST['hora']);
        file_put_contents("files/" . $_POST['nome'] . "/log.txt", $_POST['hora'] . "; " . $_POST['valor'] . PHP_EOL, FILE_APPEND);
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['nome'])) {
        //IS_DIR
        echo $valor = file_get_contents("files/" . $_GET['nome'] . "/valor.txt");
        echo $hora = file_get_contents("files/" . $_GET['nome'] . "/hora.txt");
    } else {
        echo "Faltam parâmetros no GET.";
    }
} else {
    echo "metodo nao permitido";
}

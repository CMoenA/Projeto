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

    //post metho to plain
    /*
    if (isset($_POST['value']) && isset($_POST['hour']) && isset($_POST['name'])) {

        file_put_contents("files/" . $_POST['name'] . "/value.txt", $_POST['value']);
        file_put_contents("files/" . $_POST['name'] . "/hour.txt", $_POST['hour']);
        file_put_contents("files/" . $_POST['name'] . "/log.txt", $_POST['hour'] . "; " . $_POST['value'] . PHP_EOL, FILE_APPEND);
    }
    */

    //post metho to json
    if (isset($_POST['value']) && isset($_POST['hour']) && isset($_POST['name'])) {
        //$arr = array($_POST["hour"] => $_POST["value"]);
        $arr = array("value" => $_POST["value"], "hour" => $_POST["hour"]);
        /*
        print_r('1ar:' . $arr);

        $old_array = file_get_contents("files/" . $_POST['name'] . "/log.json"); //obter os dados antigos
        if (isset($old_array)) { //se obter dados
            $old_array = json_decode(file_get_contents("files/" . $_POST['name'] . "/log.json"));
            $array = array_merge($old_array, $arr);
            print_r('2ar:' . $old_array);
        }

        file_put_contents("files/" . $_POST['name'] . "/log.json", json_encode($array));
        print_r('3ar:' . $array);

*/

        /*
        //write log
        // read the file if present
        //code based on https://stackoverflow.com/a/21725885
        $handle = @fopen("files/" . $_POST['name'] . "/log.json", 'r+');
        // create the file if needed
        if ($handle == null) {
            $handle = fopen("files/" . $_POST['name'] . "/log.json", 'w+');
        } elseif ($handle) {
            // seek to the end
            fseek($handle, 0, SEEK_END);
            // are we at the end of is the file empty
            if (ftell($handle) > 0) {
                // move back a byte
                fseek($handle, -1, SEEK_END);
                // add the trailing comma
                // add the new json string
                fwrite($handle, "," . json_encode($arr),);
                fseek($handle, -27, SEEK_END);
                fwrite();
            } else {

                // write the first event inside an array
                fwrite($handle, json_encode($arr));
            }
            // close the handle on the file
            fclose($handle);
        }
        */



        //write log
        // read the file if present
        //code based on https://stackoverflow.com/a/21725885
        $handle = @fopen("files/" . $_POST['name'] . "/log.json", 'r+');
        // create the file if needed
        if ($handle == null) {
            $handle = fopen("files/" . $_POST['name'] . "/log.json", 'w+');
        } elseif ($handle) {
            // seek to the end
            fseek($handle, 0, SEEK_END);
            // are we at the end of is the file empty
            if (ftell($handle) > 0) {
                // move back a byte
                fseek($handle, -2, SEEK_END);
                // add the trailing comma
                fwrite($handle, ',', 1);
                // add the new json string
                fwrite($handle, json_encode($arr) . ']}');
            } else {

                // write the first event inside an array
                fwrite($handle, '{"log": [' . json_encode($arr) . ']}');
            }
            // close the handle on the file
            fclose($handle);
        }

        //print_r($arr);
        //print_r(json_encode($arr));

        //

        file_put_contents("files/" . $_POST['name'] . "/value.json", json_encode($_POST["value"])); //com encode
        file_put_contents("files/" . $_POST['name'] . "/hour.json", json_encode($_POST["hour"])); // sem encode              duvida, existe alguma diferença?
        //file_put_contents("files/" . $_POST['name'] . "/log.json", json_encode($arr) . "," . PHP_EOL, FILE_APPEND); //este codigo foi alterado pelo write log de cima, porque este nao criava um json valido
        // print_r(json_encode($_POST[$arr]));
    }
}



//abaixo: get requests in json 
elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['name']) && ('s' == $_GET['log'])) {
        //IS_DIR
        echo $log = file_get_contents("files/" . $_GET['name'] . "/log.json");
    } elseif (isset($_GET['name'])) {
        //IS_DIR

        //echo $valor = '{"value":' . file_get_contents("files/" . $_GET['name'] . "/value.json");
        //echo $hora = ',"hour":"' . file_get_contents("files/" . $_GET['name'] . "/hour.json") . '}';

        $valor = file_get_contents("files/" . $_GET['name'] . "/value.json");
        $hora = file_get_contents("files/" . $_GET['name'] . "/hour.json");

        echo $arr = json_encode(array("value" => json_decode($valor), "hour" => json_decode($hora)));

        // echo $json = json_encode($arr);

        $json = $valor . $hora;

        $temperature = json_decode($json);

        //print_r("this " . $temperature->value);
        // print_r($temperature->hour);

        //echo $valor = file_get_contents("files/" . $_GET['name'] . "/value.json");
        //echo $hora = file_get_contents("files/" . $_GET['name'] . "/hour.json");
    } else {
        echo "Faltam parâmetros no GET.";
    }
}

//abaixo: pedidos get em plain
/*elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['name']) && ('s' == $_GET['log'])) {
        //IS_DIR
        echo $log = file_get_contents("files/" . $_GET['name'] . "/log.txt");
    } elseif (isset($_GET['name'])) {
        //IS_DIR
        echo $valor = file_get_contents("files/" . $_GET['name'] . "/value.txt") . " ";
        echo $hora = file_get_contents("files/" . $_GET['name'] . "/hour.txt");
    } else {
        echo "Faltam parâmetros no GET.";
    }
}*/ else {
    echo "metodo nao permitido";
}

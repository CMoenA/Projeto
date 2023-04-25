<?php
//session_start(); sempre no inicio para ligar a SESSION
//SESSION é como se fosse um cofre onde guarda as variaveis que define uma coneção
//Por defenição a sessão é finalizada quando se fecha o browser.
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
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
}

button:hover {
  opacity: 0.8;
}

/* Extra styles for the cancel button */
.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

/* Center the image and position the close button */
.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
  position: relative;
}

img.avatar {
  width: 20%;
  height: 20%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
  padding-top: 60px;
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button (x) */
.close {
  position: absolute;
  right: 25px;
  top: 0;
  color: #000;
  font-size: 35px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: red;
  cursor: pointer;
}

/* Add Zoom Animation */
.animate {
  -webkit-animation: animatezoom 0.6s;
  animation: animatezoom 0.6s
}

@-webkit-keyframes animatezoom {
  from {-webkit-transform: scale(0)} 
  to {-webkit-transform: scale(1)}
}
  
@keyframes animatezoom {
  from {transform: scale(0)} 
  to {transform: scale(1)}
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
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
    if (password_verify($_POST['password'], $password_hash)) 
    {
        echo 'Password is valid!';
        $_SESSION["username"] = $username;
        //echo "\n Sessao username: " . $_SESSION["username"];
        header("refresh:0.7;url=dashboard.php");
        } else if ($_POST['password'] == null) {
        echo "Introduza as suas credenciais.<br>";
        } else {
        echo "Invalid password.";
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
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                </ul>

                <!--ao selecioar Login, é redirecionado para o modal Login-->
                <button onclick="document.getElementById('id01').style.display='block'" class="btn btn-outline-dark" style="width:auto;">Login</button>
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

    <div id="id01" class="modal">
  
  <form class="modal-content animate" action="/projeto/dashboard.php" method="post">
    <div class="imgcontainer">
      <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
      <img src="imagens/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <label for="exampleInputEmail1"><b>Email Adress</b></label>
      <input type="text" placeholder="Enter Email" name="exampleInputEmail1" required>

      <label for="exampleInputPassword1"><b>Password</b></label>
      <input type="password" placeholder="Enter Password" name="exampleInputPassword1" required>
        
      <button type="submit" class="btn btn-outline-dark">Login</button>
      <label>
        <input type="checkbox" checked="checked" name="remember"> Remember me
      </label>
    </div>

    <div class="container" style="background-color:#f1f1f1">
      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
      <span class="psw"><a href="#">Forgot password?</a></span>
    </div>
  </form>
</div>

<script>
// Get the modal
var modal = document.getElementById('id01');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>

</html>
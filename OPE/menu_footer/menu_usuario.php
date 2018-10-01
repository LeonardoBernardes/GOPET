
<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-10 20:52:14 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:22:39
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:index.php');
    }
    //var_dump($_SESSION);
    $logi_id = $_SESSION['logi_id'];
?>


<html>

<head>

    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="../static/imagens/icon_preto.png">
    <title>GOPET</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="../static/estilo.css">


</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand logo" href="#"><img src="http://localhost/PHP/GOPET/OPE/static/imagens/gopet.png" alt="gopet"></a>
        <!-- quando a tela ficar menor irá aparecer um botão -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <button class="btn btn-light dropdown-toggle" style="margin-left:20px;" type="button" id="menu1" data-toggle="dropdown">Buscar Animais
            <span class="caret"></span></button>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                <li class="dropdown-item">
                    <a class="nav-link" tabindex="-1" href="http://localhost/PHP/GOPET/OPE/animais/buscar_animais_geo.php">Exibir no Mapa</a>
                </li>
                <li class="dropdown-item">
                    <a class="nav-link" tabindex="-1" href="#">Exibir em Lista</a>
                </li>
            </ul>

            <button class="btn btn-light dropdown-toggle" style="margin-left:20px;" type="button" id="menu2" data-toggle="dropdown">Buscar Empreendimentos
            <span class="caret"></span></button>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="menu2">
                <li class="dropdown-item">
                    <a class="nav-link" tabindex="-1" href="http://localhost/PHP/GOPET/OPE/animais/buscar_animais_geo.php">Exibir no Mapa</a>
                </li>
                <li class="dropdown-item">
                    <a class="nav-link" tabindex="-1" href="#">Exibir em Lista</a>
                </li>
            </ul>

            
            
        </div>
        <ul class="navbar-nav justify-content-end">
            <li class="nav-item active">
                <a class="btn" href="http://localhost/PHP/GOPET/OPE/logaut.php" ><img src="http://localhost/PHP/GOPET/OPE/static/icones/sair.png" style="width:30px;" alt="gopet"/></a>
            </li>
        </ul>
    </nav>


    <!-- Optional JavaScript -->
    <script src="http://localhost/PHP/GOPET/OPE/static/jquery.js"></script>
    <script src="http://localhost/PHP/GOPET/OPE/static/bootstrap/js/bootstrap.js"></script>
</body>

</html>


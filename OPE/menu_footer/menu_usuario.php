
<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-10 20:52:14 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:22:39
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');

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
    <link rel="stylesheet" href="../OPE/static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="../static/estilo.css">


</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand logo" href="../usuarios/home_usuarios.php"><img src="../static/imagens/gopet.png" alt="gopet"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <div class="dropdown">
                  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Buscar Animais
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="../animais/buscar_animais_geo.php">Exibir no Mapa</a>
                    <a class="dropdown-item" href="../animais/buscar_animais_lista.php">Exibir em Lista</a>
                  </div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Buscar Empreendimentos
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="../empreendimentos/buscar_empreendimentos_geo.php">Exibir no Mapa</a>
                    <a class="dropdown-item" href="../empreendimentos/buscar_empreendimentos_lista.php">Exibir em Lista</a>
                  </div>
                </div>
            </ul>

            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
         <ul class="navbar-nav justify-content-end">    
            <li class="nav-item active">
                <a class="btn" href="../logaut.php" ><img src="../static/icones/sair.png" style="width:30px;" alt="gopet"/></a>
            </li>
            </ul>
        </div>
    </nav>

  


    <!-- Optional JavaScript -->
    <script src="../static/jquery.js"></script>
    <script src="../static/bootstrap/js/bootstrap.js"></script>
</body>

</html>



<?php

/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-10 20:52:14 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:22:39
 */
include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';

?>

    <!-- Optional JavaScript -->
    <script src="<?php echo $server_static?>static/jquery.js"></script>
    <script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script>
<html>

<head>

    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="<?php echo $server_static;?>static/imagens/icon_preto.png">
    <title>GOPET</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand logo" href="<?php echo $server_static;?>usuarios/home_usuarios.php"><img src="<?php echo $server_static;?>static/imagens/gopet.png" alt="gopet"></a>
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
                    <a class="dropdown-item" href="<?php echo $server_static;?>animais/buscar_animais_geo.php"><img src="../static/icones/localizacao.png" style="width:20px;"/> Exibir no Mapa</a>
                    <a class="dropdown-item" href="<?php echo $server_static;?>animais/buscar_animais_lista.php"><img src="../static/icones/lista.png" style="width:20px;"/> Exibir em Lista</a>
                  </div>
                </div>
                <div class="dropdown">
                  <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Buscar Empreendimentos
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="<?php echo $server_static;?>empreendimentos/buscar_empreendimentos_geo.php"><img src="../static/icones/localizacao.png" style="width:20px;"/> Exibir no Mapa</a>
                    <a class="dropdown-item" href="<?php echo $server_static;?>empreendimentos/buscar_empreendimentos_lista.php"><img src="../static/icones/lista.png" style="width:20px;"/> Exibir em Lista</a>
                  </div>
                </div>
            </ul>
         <ul class="navbar-nav justify-content-end">    
            <li class="nav-item active">
                <a class="btn" href="<?php echo $server_static;?>logaut.php" ><img src="../static/icones/sair.png" style="width:30px;" alt="gopet"/></a>
            </li>
            </ul>
        </div>
    </nav>
</body>

</html>


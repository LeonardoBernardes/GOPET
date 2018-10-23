<?php

/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:59:32 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 18:54:56
 */
include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.'index.php');
    }
 
$logado = $_SESSION['login'];


?>
<head>

    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="<?php echo $server_static;?>static/imagens/icon_preto.png">
    <title>GOPET</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">


</head>

<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand logo" href="#" ><img src="<?php echo $server_static;?>static/imagens/gopet.png" alt="gopet"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
 
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $server_static;?>administradores/cadastro_grupos.php">Criar Grupo</a
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $server_static;?>administradores/ativa_usuarios.php">Ativar Usuários</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $server_static;?>administradores/ativa_empreendimentos.php">Ativar Empreendimentos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $server_static;?>animais/cadastro_animais.php">Cadastrar Animais</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="<?php echo $server_static;?>animais/consultar_animais.php">Consultar Animais</a>
            </li>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item active">
                    <a class="btn" href="http://localhost/PHP/GOPET/OPE/logaut.php" ><img src="http://localhost/PHP/GOPET/OPE/static/icones/sair.png" style="width:30px;" alt="gopet"/></a>
                </li>
            </ul> 
        </div>
</nav>
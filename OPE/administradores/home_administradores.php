<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:59:32 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 18:54:56
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];


?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/estilo.css">
    <title>Gopet</title>
</head>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand logo" href="#" ><img src="../static/imagens/gopet.png" alt="gopet"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                
 
            <li class="nav-item active">
                <a class="nav-link" href="..\administradores\cadastro_grupos.php">Criar Grupo</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="..\administradores\ativa_usuarios.php">Ativar Usuários</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="..\administradores\ativa_empreendimentos.php">Ativar Empreendimentos</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="..\animais\cadastro_animais.php">Cadastrar Animais</a>
            </li>
            <li class="nav-item active">
                <a class="nav-link" href="..\animais\consultar_animais.php">Consultar Animais</a>
            </li>
            </ul>
            <ul class="navbar-nav justify-content-end">
                <li class="nav-item active">
                    <a class="btn" href="http://localhost/PHP/GOPET/OPE/logaut.php" ><img src="http://localhost/PHP/GOPET/OPE/static/icones/sair.png" style="width:30px;" alt="gopet"/></a>
                </li>
            </ul> 
        </div>
</nav>

<!-- MEIO -->
<div class="one_page home">
<div class="card_titulo p-4">
    <h2>Sua pagina como Administrador</h2>
    </div>
</div>

    <script src="../static/jquery.js"></script>
    <script src="../static/bootstrap/js/bootstrap.js"></script>


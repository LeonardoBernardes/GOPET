<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:59:32 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 19:27:03
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        unset($_SESSION['logi_id']);
        unset($_SESSION['logi_status']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];
$logi_id = $_SESSION['logi_id'];
//$status_empr = $_SESSION['logi_status'];

$menu_eventos = '';

//Pega o id do empreendimento que esse usuário está atrelado
$sql = "SELECT
            empr_id
        FROM
            login_x_empreendimentos
        WHERE
            logi_id  = $logi_id   
    ";

$result = mysqli_query($conn, $sql);
$row2 = mysqli_fetch_object($result);

//var_dump($_SESSION);
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
                
                 <?php   if($_SESSION['grup_id'] == 4){ ?>
                   <li class="nav-item active">
                    <a class="nav-link" href="..\empreendimentos\cadastro_empreendimentos.php">Dados</a>
                    </li>
                    <li class="nav-item active">                    
                    <a class="nav-link" href="..\empreendimentos\funcionarios\cadastro_funcionarios.php">Cadastrar funcionários</a>
                    </li>
                    <li class="nav-item active">     
                    <a class="nav-link" href="..\empreendimentos\funcionarios\consultar_funcionarios.php">Consultar funcionários</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="..\logaut.php">Logaut</a>
                    </li>
                       
        <?php   } ?>

    <?php   if($_SESSION['logi_status'] == 1){ 

                if(!empty($row2)){
            
            ?>       
                    <li class="nav-item active">  
                    <a class="nav-link" href="..\empreendimentos\produtos\cadastro_produtos.php">Cadastrar Produtos</a>
                    </li>
                    <li class="nav-item active">  
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    <a class="nav-link" href="..\empreendimentos\produtos\consultar_produtos.php">Consultar Produtos</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="..\empreendimentos\servicos\cadastro_servicos.php">Cadastrar Serviços</a>
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="..\empreendimentos\servicos\consultar_servicos.php">Consultar Serviços</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="..\empreendimentos\eventos\cadastro_eventos.php">Cadastrar Eventos</a>
                    </li>
                    <li class="nav-item active">
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    <a class="nav-link" href="..\empreendimentos\eventos\consultar_eventos.php">Consultar Eventos</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="..\animais\cadastro_animais.php">Cadastrar Animais</a>
                    </li>
                    <li class="nav-item active">
                    <a class="nav-link" href="..\animais\consultar_animais.php">Consultar Animais</a>
                    </li>

                    <?php 
                }
            } ?>
            </ul></div></nav>
     
    


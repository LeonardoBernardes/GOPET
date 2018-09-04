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
    <fieldset id="fie">
        <span>GOPET </span><br/>
        
        <?php   if($_SESSION['grup_id'] == 4){ ?>
                    <a href="..\empreendimentos\cadastro_empreendimentos.php">Dados</a>
                    <a href="..\empreendimentos\funcionarios\cadastro_funcionarios.php">Cadastrar funcionários</a>
                    <a href="..\empreendimentos\funcionarios\consultar_funcionarios.php">Consultar funcionários</a>
        <?php   } ?>

    <?php   if($_SESSION['logi_status'] == 1){ 

                if(!empty($row2)){
            
            ?>
                    <a href="..\empreendimentos\produtos\cadastro_produtos.php">Cadastrar Produtos</a>
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    <a href="..\empreendimentos\produtos\consultar_produtos.php">Consultar Produtos</a>
                    <a href="..\empreendimentos\servicos\cadastro_servicos.php">Cadastrar Serviços</a>
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    <a href="..\empreendimentos\servicos\consultar_servicos.php">Consultar Serviços</a>
                    <a href="..\empreendimentos\eventos\cadastro_eventos.php">Cadastrar Eventos</a>
                    <!-- Só exibir se tiver um cadastro ativo (Farei depois) -->
                    <a href="..\empreendimentos\eventos\consultar_eventos.php">Consultar Eventos</a>
                    <a href="..\animais\cadastro_animais.php">Cadastrar Animais</a>
                    <a href="..\animais\consultar_animais.php">Consultar Animais</a>
                    <?php 
                }
            } ?>
    </fieldset>

<a href="..\logaut.php">LOGAUT</a>
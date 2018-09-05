<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 20:35:25
 */

include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 

$foto = $_FILES["logo"];    
$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];

$even_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$ra = ($_POST['ra']) ? $_POST['ra'] : 0;
$idade = ($_POST['idade']) ? $_POST['idade'] : "";
$even_status = ($_POST['porte']) ? $_POST['porte'] : "";
 
?>
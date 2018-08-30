<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:59:32 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:56:02
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];


?>


    <fieldset id="fie">
        <span>GOPET </span><br/>

        <a href="..\usuarios\cadastro_usuarios.php">Dados</a>
       
    </fieldset>

<a href="..\logaut.php">LOGAUT</a>
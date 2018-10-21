<?php
include_once 'config/server.php';

/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:22:39 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:45:04
 */

include_once ROOT_PATH.'\mysql_conexao\conexao_mysql.php';

session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];


unset ($_SESSION['login']);
unset ($_SESSION['senha']);


header('location:'.$server_static.' index.php');
?>


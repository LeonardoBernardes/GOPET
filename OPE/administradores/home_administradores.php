<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:59:32 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:54:49
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
    <fieldset id="fie">
        <span>GOPET </span><br/>
            <a href="..\administradores\cadastro_grupos.php">Criar Grupo</a>
            <a href="..\administradores\ativa_usuarios.php">Ativar Usuários</a>
            <a href="..\administradores\ativa_empreendimentos.php">Ativar Empreendimentos</a>
    </fieldset>

<a href="..\logaut.php">LOGAUT</a>
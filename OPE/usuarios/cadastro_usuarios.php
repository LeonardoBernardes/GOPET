<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:55:58
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
<form method="post" action="cadastrar_usuarios.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Dados Usuários</legend><br/>
        <label>NOME : </label> 
        <input type="text" name="nome" id="nome"><br/>
        <label>Sobrenome : </label> 
        <input type="text" name="sobrenome" id="sobrenome"><br/>
        <label>CPF : </label> 
        <input type="text" name="cpf" id="cpf"><br/>
        <label>Data de Nascimento : </label> 
        <input type="text" name="data_nascimento" id="data_nascimento"><br/>
        <input type="submit" value="Salvar Dados">
    </fieldset>
</form>
<a href="..\logaut.php">LOGAUT</a>
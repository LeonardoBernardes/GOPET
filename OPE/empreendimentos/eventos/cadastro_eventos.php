<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:53:30
 */
include_once(dirname( __FILE__ ) .'\..\..\mysql_conexao\conexao_mysql.php');
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
<form method="post" action="cadastrar_eventos.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastrar Evento</legend><br/>
        <label>Nome : </label> 
        <input type="text" name="nome" id="nome"><br/>
        <label>Descrição : </label> 
        <input type="text" name="descricao" id="descricao"><br/>
        <label>Data de Realização : </label> 
        <input type="text" name="data_realizacao" id="data_realizacao"><br/>
        <label>Status : </label> 
        <select name="status">
            <option value="1">Ativo</option>
            <option value="0" selected>Desativado</option>
        </select>
        <input type="submit" value="Cadastrar">
        
    </fieldset>
    
</form>
<a href="..\home_empreendimento.php"> Voltar</a>
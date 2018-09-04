<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 19:23:16
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


 
?>
<form method="post" action="cadastrar_animais.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastrar Animal</legend><br/>

        <input type="radio" name="tipo_cadastro" value="resgate"> Resgate<br>
        <input type="radio" name="tipo_cadastro" value="doacao"> Doação<br>
        <label>LOGIN : </label> 
        <input type="text" name="login_funcionario" id="login_funcionario"><br/>
        <label>EMAIL : </label> 
        <input type="text" name="email" id="email"><br/>
        <label>SENHA : </label> 
        <input type="password" name="senha" id="senha"><br/>
       
        <input type="submit" value="CADASTRAR">
    </fieldset>
</form>
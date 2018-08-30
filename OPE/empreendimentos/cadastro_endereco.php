
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:47:59
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
<form method="post" action="cadastrar_empreendimento.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastro Endereço</legend><br/>
        <label>Pais : </label> 
        <input type="text" name="pais" id="pais"><br/>
        <label>Estado : </label> 
        <input type="text" name="estado" id="estado"><br/>
        <label>Cidade : </label> 
        <input type="text" name="cidade" id="cidade"><br/>
        <label>Bairro : </label> 
        <input type="text" name="bairro" id="bairro"><br/>
        <label>Logradouro : </label> 
        <input type="text" name="logradouro" id="logradouro"><br/>
        <label>Número : </label> 
        <input type="text" name="numero" id="numero"><br/>
        <label>Complemento : </label> 
        <input type="text" name="complemento" id="complemento"><br/>
        <label>CEP : </label> 
        <input type="text" name="cep" id="cep"><br/>

        <input type="submit" value="Salvar Endereço">
        
    </fieldset>
    <a href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
</form>
<a href="..\logaut.php">LOGAUT</a>
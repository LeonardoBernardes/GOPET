
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:54:57
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

$sql="SELECT * FROM empreendimentos WHERE";
$result =  mysqli_query($conn, $sql);




?>
<form method="post" action="cadastrar_grupos.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastrar Grupos</legend><br/>
        <label>NOME DO GRUPO : </label> 
        <input type="text" name="nome" id="nome"><br/>
        <input type="submit" value="Salvar Dados">
        
    </fieldset>
    <a href="..\administradores\home_administradores.php"> Voltar</a>
</form>
<a href="..\logaut.php">LOGAUT</a>
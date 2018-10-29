
<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:34:11 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 01:10:31
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
 
$logado = $_SESSION['login'];

$grup_descricao = ($_POST['nome']) ? $_POST['nome'] : "";


$sql2 = "  INSERT INTO 
                grupos
            ( 
                grup_descricao, 
                grup_data_cadastro 
            ) 
            VALUES 
                ( 
                    '$grup_descricao',
                    NOW()
                ) ";
//echo $sql2;
$c2 = mysqli_query($conn, $sql2);

?>

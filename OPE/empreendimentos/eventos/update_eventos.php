<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:53:21
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

$even_id = $_GET['id'];

$even_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$even_descricao = ($_POST['descricao']) ? $_POST['descricao'] : "";
$even_data_realizacao = ($_POST['data_realizacao']) ? $_POST['data_realizacao'] : "";
$even_status = ($_POST['status']) ? $_POST['status'] : 0;



$sql ="  UPDATE 
            eventos
        SET 
            even_nome = '$even_nome', 
            even_descricao = '$even_descricao', 
            even_data_realizacao = '$even_data_realizacao',
            even_status = $even_status
        WHERE 
            even_id = $even_id
        ";
//echo $sql;
$result =  mysqli_query($conn, $sql);
header('location:..\eventos\consultar_eventos.php');
//echo $prod_id;


?>
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:51:43
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

$serv_id = $_GET['id'];
$serv_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$serv_descricao = ($_POST['descricao']) ? $_POST['descricao'] : "";
$serv_valor_total = ($_POST['valor_total']) ? $_POST['valor_total'] : "";
$serv_promocao = ($_POST['promocao']) ? $_POST['promocao'] : 0;
$serv_valor_promocao = ($_POST['valor_promocao']) ? $_POST['valor_promocao'] : 0;
$serv_status = ($_POST['status']) ? $_POST['status'] : 0;



$sql ="  UPDATE 
            servicos
        SET 
            serv_nome = '$serv_nome',
            serv_descricao = '$serv_descricao',
            serv_valor_total = $serv_valor_total,
            serv_promocao = $serv_promocao,
            serv_valor_promocao = $serv_valor_promocao,
            serv_status = $serv_status
        WHERE 
            serv_id = $serv_id
        ";

$result =  mysqli_query($conn, $sql);
header('location:..\servicos\consultar_servicos.php');
//echo $prod_id;


?>
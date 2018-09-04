<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 01:17:38
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

$funcionario_id = $_GET['id'];

$funcionarios_login = ($_POST['login_funcionario']) ? $_POST['login_funcionario'] : "";
$funcionarios_email = ($_POST['email']) ? $_POST['email'] : "";
$funcionarios_senha = ($_POST['senha']) ? $_POST['senha'] : "";
$funcionarios_status = ($_POST['status']) ? $_POST['status'] : 0;



$sql ="  UPDATE 
            login
        SET 
            logi_nome =  '$funcionarios_login', 
            logi_email = '$funcionarios_email', 
            logi_senha = '$funcionarios_senha',
            logi_status = $funcionarios_status,
            logi_data_atualizacao = NOW()
        WHERE 
            logi_id = $funcionario_id
        ";
//echo $sql;
$result =  mysqli_query($conn, $sql);




header('location:..\funcionarios\consultar_funcionarios.php');
//echo $prod_id;



?>
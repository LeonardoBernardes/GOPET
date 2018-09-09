<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 19:42:14 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-07 00:28:11
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
$logi_id = $_SESSION['logi_id'];
$grup_id = $_SESSION['grup_id'];

$usua_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$usua_sobrenome = ($_POST['sobrenome']) ? $_POST['sobrenome'] : "";
$usua_cpf = ($_POST['cpf']) ? $_POST['cpf'] : "";
$usua_dt_nascimento = ($_POST['data_nascimento']) ? $_POST['data_nascimento'] : "";


$sql = "   INSERT INTO 
                usuarios 
                    (
                        usua_nome,
                        usua_sobrenome,
                        usua_cpf,
                        usua_dt_nascimento,
                        usua_status,
                        
                        usua_data_cadastro    
                    )
            VALUES 
                    (
                        '$usua_nome',
                        '$usua_sobrenome',
                        '$usua_cpf',
                        '$usua_dt_nascimento',
                        0,                        
                        '2018-08-13 18:35:00'
                    )";
//echo $sql2;
$c2 = mysqli_query($conn, $sql);


$query= " SELECT max(usua_id) as usua_id from usuarios ";
//echo $query;
$result = mysqli_query($conn, $query);
$row2 = mysqli_fetch_object($result);

$sql3 = "   INSERT INTO 
                login_x_usuarios 
                    (
                        logi_id,
                        usua_id,
                        grup_id   
                    )
            VALUES 
                    (
                        $logi_id,
                        $row2->usua_id,
                        $grup_id
                    )";
//echo $sql3;
$c3 = mysqli_query($conn, $sql3);
//echo $sql2;
header('location:..\home_usuarios.php');

?>
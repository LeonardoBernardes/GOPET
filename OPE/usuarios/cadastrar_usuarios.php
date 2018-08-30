<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 19:42:14 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:55:54
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



$sql2="  SELECT 
            logi_id 
        FROM 
            `login` 
        WHERE 
            `logi_nome` = '$_SESSION["login"]' 
            AND `logi_senha`= '$_SESSION["senha"]'
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql2);

?>
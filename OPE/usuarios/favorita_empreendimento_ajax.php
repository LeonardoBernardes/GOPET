<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-11-26 17:32:57 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-11-26 18:28:38
 */
include_once '../config/server.php';
include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
{
    unset($_SESSION);
    header('location:'.$server_static.'index.php');
}

$empr_id = $_GET['empr_id'];
$logado = $_SESSION['login'];
$logi_id = $_SESSION['logi_id'];
$grup_id = $_SESSION['grup_id'];

//Pega o id do empreendimento que esse usuário está atrelado
$sql = "SELECT
            usua_id
        FROM
            login_x_usuarios
        WHERE
            logi_id  = $logi_id   
";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);


//Pega todos os eventos  daquele empreendimento
$sql_favoritos="SELECT empr_id,faem_status FROM favoritos_empreendimentos WHERE usua_id = $row->usua_id AND empr_id = $empr_id";
$result = mysqli_query($conn, $sql_favoritos);
$row2 = mysqli_fetch_object($result);


//var_dump($ids);
if(empty($row2)){

    $sql3="INSERT INTO
            favoritos_empreendimentos
            (faem_status,faem_data_cadastro,empr_id,usua_id)
            VALUES
            (1,NOW(),$empr_id, $row->usua_id)
        ";
   // echo $sql3;
    $result = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_object($result);
}else{
    if($row2->faem_status == 1){
        $sql3="UPDATE
        favoritos_empreendimentos
        SET
            faem_status = 0,
            faem_data_atualizacao = NOW()
        WHERE
            usua_id = $row->usua_id
            AND empr_id=$empr_id
    ";
    }else{
        $sql3="UPDATE
        favoritos_empreendimentos
        SET
            faem_status = 1,
            faem_data_atualizacao = NOW()
        WHERE
            usua_id = $row->usua_id
            AND empr_id=$empr_id
    ";
    }

    $result = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_object($result);
}

?>
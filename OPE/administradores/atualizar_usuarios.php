<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:59:04 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:55:06
 */

include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];

$logi_id = $_GET['id'];

//echo $logi_id;
$sql="  SELECT 
            logi_status
        FROM 
            `login` 
        WHERE 
            logi_id = $logi_id 
            
        ";
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);


if($row->logi_status == 0){
$sql2="  UPDATE 
            login
            SET logi_status = 1
        WHERE logi_id = $logi_id
        ";

}else{
    $sql2="  UPDATE 
            login
            SET logi_status = 0
        WHERE logi_id = $logi_id
        ";
}

$result =  mysqli_query($conn, $sql2);

header('location:..\administradores\ativa_usuarios.php');

?>
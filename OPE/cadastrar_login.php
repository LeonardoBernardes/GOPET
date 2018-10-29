
<?php
include_once 'config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:34:11 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-05 21:24:26
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

$logi_nome =  ($_POST['login']) ? $_POST['login'] : "";
$logi_email = ($_POST['email']) ? $_POST['email'] : "";
$logi_senha = ($_POST['senha']) ? $_POST['senha'] : "";
$grupo_id =   ($_POST['tipo_usuario']) ? $_POST['tipo_usuario'] : "";

$sql2 = "   INSERT INTO 
                login 
                ( 
                    logi_nome, 
                    logi_email,
                    logi_senha,
                    logi_status, 
                    logi_data_cadastro,
                    grup_id
                ) 
                VALUES 
                ( 
                    '$logi_nome',
                    '$logi_email',
                    '$logi_senha',
                    0, 
                    NOW(), 
                    $grupo_id)";
//echo $sql2;
$c2 = mysqli_query($conn, $sql2);

header('location: '.$server_static.' index.php');

?>

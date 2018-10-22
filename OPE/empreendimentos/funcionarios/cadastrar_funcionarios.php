
<?php 
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:34:11 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 01:17:22
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.'index.php');
    }


$logi_id = $_SESSION['logi_id'];   

$logi_nome = ($_POST['login_funcionario']) ? $_POST['login_funcionario'] : "";
$logi_email = ($_POST['email']) ? $_POST['email'] : "";
$logi_senha = ($_POST['senha']) ? $_POST['senha'] : "";
$grup_id = 2;

//Pega o id do empreendimento que esse usuário está atrelado
$sql2 = "SELECT
            empr_id
        FROM
            login_x_empreendimentos
        WHERE
            logi_id  = $logi_id   
    ";
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_object($result);

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
                    $grup_id)";
//echo $sql2;
$c2 = mysqli_query($conn, $sql2);

$query= " SELECT max(logi_id) as logi_id from login";
//echo $query;
$result = mysqli_query($conn, $query);
$row3 = mysqli_fetch_object($result);

$sql3 = "   INSERT INTO 
                    login_x_empreendimentos 
                        (
                            logi_id,
                            empr_id,
                            grup_id   
                        )
                VALUES 
                        (
                            $row3->logi_id,
                            $row2->empr_id,
                            $grup_id
                        )";
   // echo $sql3;
    $c3 = mysqli_query($conn, $sql3);

header('location:..\home_empreendimento.php');

?>

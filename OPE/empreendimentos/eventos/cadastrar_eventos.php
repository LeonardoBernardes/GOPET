<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:53:34
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


$even_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$even_descricao = ($_POST['descricao']) ? $_POST['descricao'] : "";
$even_data_realizacao = ($_POST['data_realizacao']) ? $_POST['data_realizacao'] : "";
$even_status = ($_POST['status']) ? $_POST['status'] : 0;



//$empr_status = $_POST['status'] ? : "";

//Pega o login do usuário
$sql = "SELECT
            logi_id
        FROM
            login
        WHERE   
            logi_nome = '$logado'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);

//Pega o id do empreendimento que esse usuário está atrelado
$sql2 = "SELECT
            empr_id
        FROM
            login_x_empreendimentos
        WHERE
            logi_id  = $row->logi_id   
    ";
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_object($result);

//Insere o evento
$sql3 = "   INSERT INTO 
                eventos 
                    (
                        even_nome,
                        even_descricao,
                        even_data_realizacao,
                        even_status,
                        even_data_cadastro    
                    )
            VALUES 
                    (
                        '$even_nome',
                        '$even_descricao',
                        '$even_data_realizacao',
                         $even_status,
                        '1998-11-20'
                    )";
//echo $sql3;
$c2 = mysqli_query($conn, $sql3);

$query= " SELECT max(even_id) as even_id from eventos";
//echo $query;
$result = mysqli_query($conn, $query);
$row3 = mysqli_fetch_object($result);


$sql3 = "   INSERT INTO 
                empreendimentos_x_eventos 
                    (
                        empr_id,
                        even_id,
                        emev_data_cadastro   
                    )
            VALUES 
                    (
                        $row2->empr_id,
                        $row3->even_id,
                        '1998-11-20'
                    )";
//echo $sql3;
$c3 = mysqli_query($conn, $sql3);

header('location:..\eventos\consultar_eventos.php');

?>
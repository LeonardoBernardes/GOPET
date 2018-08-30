<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:49:37
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


$serv_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$serv_descricao = ($_POST['descricao']) ? $_POST['descricao'] : "";
$serv_valor_total = ($_POST['valor_total']) ? $_POST['valor_total'] : "";
$serv_promocao = ($_POST['promocao']) ? $_POST['promocao'] : 0;
$serv_valor_promocao = ($_POST['valor_promocao']) ? $_POST['valor_promocao'] : 0;
$serv_status = ($_POST['status']) ? $_POST['status'] : 0;



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

//Insere o produto
$sql3 = "   INSERT INTO 
                servicos 
                    (
                        empr_id,
                        serv_nome,
                        serv_descricao,
                        serv_valor_total,
                        serv_promocao,
                        serv_valor_promocao,
                        serv_status,
                        serv_data_cadastro    
                    )
            VALUES 
                    (
                        $row2->empr_id,
                        '$serv_nome',
                        '$serv_descricao',
                         $serv_valor_total,
                         $serv_promocao,
                         $serv_valor_promocao,
                         $serv_status,
                        '1998-11-20'
                    )";
//echo $sql3;
$c2 = mysqli_query($conn, $sql3);

header('location:..\servicos\consultar_servicos.php');

?>
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 20:15:20
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


$emen_pais = ($_POST['pais']) ? $_POST['pais'] : "";
$emen_estado = ($_POST['estado']) ? $_POST['estado'] : "";
$emen_cidade = ($_POST['cidade']) ? $_POST['cidade'] : "";
$emen_bairro = ($_POST['bairro']) ? $_POST['bairro'] : "";
$emen_logradouro = ($_POST['logradouro']) ? $_POST['logradouro'] : 0;
$emen_numero = ($_POST['numero']) ? $_POST['numero'] : 0;
$emen_complemento = ($_POST['complemento']) ? $_POST['complemento'] : 0;
$emen_cep = ($_POST['cep']) ? $_POST['cep'] : 0;
//continuar daqui//


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


$sql3 = "   INSERT INTO 
                empreendimentos_enderecos 
                    (
                        emen_pais,
                        emen_estado,
                        emen_cidade,
                        emen_bairro,
                        emen_logradouro,
                        emen_numero,
                        emen_complemento,
                        emen_data_cadastro,
                        empr_id
                    )
            VALUES 
                    (
                        '$emen_pais',
                        '$emen_estado',
                        '$emen_cidade',
                        '$emen_bairro',
                        '$emen_logradouro',
                        $emen_numero,
                        '$emen_complemento',
                        '1998-11-20',
                        $row2->empr_id
                    )";
//echo $sql3;
$c2 = mysqli_query($conn, $sql3);
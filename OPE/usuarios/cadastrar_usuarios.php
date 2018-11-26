<?php
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 19:42:14 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-24 22:14:14
 */
include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
 
$logado = $_SESSION['login'];
$logi_id = $_SESSION['logi_id'];
$grup_id = $_SESSION['grup_id'];

$usua_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$usua_sobrenome = ($_POST['sobrenome']) ? $_POST['sobrenome'] : "";
$usua_cpf = ($_POST['cpf']) ? $_POST['cpf'] : "";
$usua_dt_nascimento = ($_POST['data_nascimento']) ? $_POST['data_nascimento'] : "";

//enderecos
$usen_pais = ($_POST['pais']) ? $_POST['pais'] : "";
$usen_estado = ($_POST['estado']) ? $_POST['estado'] : "";
$usen_cidade = ($_POST['cidade']) ? $_POST['cidade'] : "";
$usen_bairro = ($_POST['bairro']) ? $_POST['bairro'] : "";
$usen_logradouro = ($_POST['logradouro']) ? $_POST['logradouro'] : 0;
$usen_numero = ($_POST['numero']) ? $_POST['numero'] : 0;
$usen_complemento = ($_POST['complemento']) ? $_POST['complemento'] : 0;
$usen_cep = ($_POST['cep']) ? $_POST['cep'] : 0;

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

//Salvar endereco do empreendimento
$query= " SELECT usua_id from usuarios_enderecos where usua_id = $row2->usua_id";
//echo $query;
$result = mysqli_query($conn, $query);
$row3 = mysqli_fetch_object($result);

if(empty($row3)){    
    $sql4 = "   INSERT INTO 
                    usuarios_enderecos 
                        (
                            usen_pais,
                            usen_estado,
                            usen_cidade,
                            usen_bairro,
                            usen_logradouro,
                            usen_numero,
                            usen_complemento,
                            usen_cep,
                            usen_data_cadastro,
                            usua_id
                        )
                VALUES 
                        (
                            '$usen_pais',
                            '$usen_estado',
                            '$usen_cidade',
                            '$usen_bairro',
                            '$usen_logradouro',
                             $usen_numero,
                            '$usen_complemento',
                             $usen_cep,
                             NOW(),
                             $row2->usua_id
                        )";
    //echo $sql4;
    $c2 = mysqli_query($conn, $sql4);
}else{
    //continuar daqui 

    $sql2 = "   UPDATE 
                    usuarios_enderecos 
                SET   
                    usen_pais = '$usen_pais',
                    usen_estado = '$usen_estado',
                    usen_cidade = '$usen_cidade',
                    usen_bairro =  '$usen_bairro',
                    usen_logradouro = '$usen_logradouro',
                    usen_numero = '$usen_numero',
                    usen_complemento = '$usen_complemento',
                    usen_cep = '$usen_cep',
                    usen_data_atualizacao = NOW()
                        
                WHERE 
                    usua_id = $row2->usua_id";
   // echo $sql2;
    $c3 = mysqli_query($conn, $sql2);

}




header('location:..\usuarios\home_usuarios.php');

?>
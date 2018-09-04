<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-03 00:42:22
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
$logi_id = $_SESSION['logi_id'];
$status  = '';
$results = "";
//$ids = '';

//Pega o id do empreendimento que esse usuário está atrelado
$sql2 = "SELECT
            empr_id
        FROM
            login_x_empreendimentos
        WHERE
            logi_id  = $logi_id   
    ";
//   echo $sql2;
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_object($result);



//Pega todos os eventos  daquele empreendimento
$sql2 = "SELECT
            logi_id
        FROM
            login_x_empreendimentos
        WHERE
            empr_id  = $row2->empr_id 
            AND grup_id = 2  
    ";
    //echo $sql2;
$result = mysqli_query($conn, $sql2);
while($row2 = mysqli_fetch_object($result)){

    if(!isset($ids)){
        $ids = $row2->logi_id;
    }
    $ids = $ids.",".$row2->logi_id;
    

}
//var_dump($ids);
$sql="  SELECT 
            logi_id,
            logi_nome,
            logi_senha,
            logi_email,
            logi_data_cadastro,
            logi_data_atualizacao,
            logi_status
        FROM 
            `login` 
        WHERE 
            `logi_id` in ($ids) 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
while ($row = mysqli_fetch_object($result)) {

    if($row->logi_status == 0){
        $status = "DESATIVADO";
    }else{
        $status = "ATIVADO";
    }


    $results .='<tr>
                    <td>'.$row->logi_id.'</td>
                    <td>'.$row->logi_nome.'</td>
                    <td>'.$row->logi_senha.'</td>
                    <td>'.$row->logi_email.'</td>
                    <td>'.$row->logi_data_cadastro.'</td>
                    <td>'.$row->logi_data_atualizacao.'</td>
                    <td>'.$status.'</td>
                    <td><a href="..\funcionarios\atualizar_funcionarios.php?id='.$row->logi_id.'"> Editar</a></td>
                </tr>';
//echo $results;
}
 
?>

<!DOCTYPE html>
<html>
    <head>
        <style>
            table, th, td {
                border: 1px solid black;
                border-collapse: collapse;
            }
            th, td {
                padding: 5px;
            }
            th {
                text-align: left;
            }
        </style>
    </head>
<body>
<table style="width:100%">
    <tr>
        <th>ID</th>    
        <th>Nome</th>
        <th>Senha</th>
        <th>Email</th>
        <th>Data Cadastro</th>
        <th>Data Atualização</th>
        <th>Status</th>
        <th>Editar</th>
    </tr>
    <?php echo $results ?>
</table>
<a href="..\home_empreendimento.php"> Voltar</a>
</body>
</html>
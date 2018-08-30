<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:53:25
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

$status  = '';
$results = "";
//$ids = '';

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
//   echo $sql2;
$result = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_object($result);



//Pega todos os eventos  daquele empreendimento
$sql2 = "SELECT
            even_id
        FROM
            empreendimentos_x_eventos
        WHERE
            empr_id  = $row2->empr_id   
    ";
    //echo $sql2;
$result = mysqli_query($conn, $sql2);
while($row2 = mysqli_fetch_object($result)){

    if(!isset($ids)){
        $ids = $row2->even_id;
    }
    $ids = $ids.",".$row2->even_id;
    

}
//var_dump($ids);
$sql="  SELECT 
            even_id,
            even_nome,
            even_descricao,
            even_data_realizacao,
            even_status
        FROM 
            `eventos` 
        WHERE 
            `even_id` in ($ids) 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
while ($row = mysqli_fetch_object($result)) {

    if($row->even_status == 0){
        $status = "DESATIVADO";
    }else{
        $status = "ATIVADO";
    }

    $results .='<tr>
                    <td>'.$row->even_id.'</td>
                    <td>'.$row->even_nome.'</td>
                    <td>'.$row->even_descricao.'</td>
                    <td>'.$row->even_data_realizacao.'</td>
                    <td>'.$status.'</td>
                    <td><a href="..\eventos\atualizar_eventos.php?id='.$row->even_id.'"> Editar</a></td>
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
        <th>Descrição</th>
        <th>Data de realização</th>
        <th>Status</th>
        <th>Editar</th>
    </tr>
    <?php echo $results ?>
</table>
<a href="..\home_empreendimento.php"> Voltar</a>
</body>
</html>
<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-28 19:21:29
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
$login = $_SESSION['login'];
$senha = $_SESSION['senha'];
$status = $grupo = '';
$results = "";

$sql="  SELECT 
            logi_id,
            logi_nome,
            logi_email,
            logi_status,
            grup_id 
        FROM 
            `login` 
        WHERE 
            `logi_nome` <> '$login' 
            AND grup_id = 2
            OR grup_id = 4
            
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

    if($row->grup_id == 1){
        $grupo = "ADMINISTRATIVO";
    }elseif($row->grup_id == 2){
        $grupo = "EMPREENDIMENTOS";
    }elseif($row->grup_id == 3){
        $grupo = "USUÁRIOS";
    }elseif($row->grup_id == 4){
        $grupo = "ADMINISTRADOR DE EMPREENDIMENTOS";
    }


    $results .='<tr>
                    <td>'.$row->logi_id.'</td>
                    <td>'.$row->logi_nome.'</td>
                    <td>'.$row->logi_email.'</td>
                    <td>'.$status.'</td>
                    <td>'.$grupo.'</td>
                    <td><a href="..\administradores\atualizar_empreendimentos.php?id='.$row->logi_id.'"> Ativar ou Desativar</a></td>
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
        <th>Nome Login</th>
        <th>Email</th> 
        <th>Status</th>
        <th>Grupo</th>
        <th>Editar</th>
    </tr>
    <?php echo $results ?>
</table>
<a href="..\administradores\home_administradores.php"> Voltar</a>
</body>
</html>
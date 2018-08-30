<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-30 01:39:46
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

$status = $grupo = '';
$results = "";



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

$sql="  SELECT 
            prod_id,
            prod_nome,
            prod_marca,
            prod_descricao,
            prod_valor_total,
            prod_promocao,
            prod_valor_promocao,
            prod_status
        FROM 
            `produtos` 
        WHERE 
            `empr_id` = '$row2->empr_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
while ($row = mysqli_fetch_object($result)) {

    if($row->prod_status == 0){
        $status = "DESATIVADO";
    }else{
        $status = "ATIVADO";
    }

    $sql3=" SELECT 
                prim_endereco
            FROM 
                produtos_imagens 
            WHERE 
                empr_id = $row2->empr_id
                AND prod_id = $row->prod_id";
    //echo $sql3;
    $result4 =  mysqli_query($conn, $sql3);
    $row5 = mysqli_fetch_object($result4);


    $endereco_img = '';
    if(!empty($row5)){
        $endereco_img = $row5->prim_endereco;
    }
    if(!empty($endereco_img)){
    //Criar Funcao para trazer local host como variavel
    $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/OPE/empreendimentos/produtos/'.$endereco_img);
    }
    

    $results .='<tr>
                    
                    <td>'.$row->prod_id.'</td>
                    <td><img src="'.$endereco_img.'"/></td>
                    <td>'.$row->prod_nome.'</td>
                    <td>'.$row->prod_marca.'</td>
                    <td>'.$row->prod_descricao.'</td>
                    <td>'.$row->prod_valor_total.'</td>
                    <td>'.$row->prod_promocao.'</td>
                    <td>'.$row->prod_valor_promocao.'</td>
                    <td>'.$status.'</td>
                    
                    <td><a href="..\produtos\atualizar_produtos.php?id='.$row->prod_id.'"> Editar</a></td>
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

<h2>Left-align Headings</h2>
<p>To left-align the table headings, use the CSS text-align property.</p>

<table style="width:100%">
    <tr>
        <th>ID</th>  
        <th>imagem</th>   
        <th>Nome</th>
        <th>Marca</th>
        <th>Descrição</th>
        <th>Valor Total</th> 
        <th>Possuí Promoção ?</th>
        <th>Valor Promoção</th>
        <th>Status</th>
        <th>Editar</th>
    </tr>
    <?php echo $results ?>
</table>
<a href="..\home_empreendimento.php"> Voltar</a>
</body>
</html>
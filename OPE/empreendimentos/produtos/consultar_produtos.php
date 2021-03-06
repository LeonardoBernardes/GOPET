<?php
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:54:22
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
            prod_qtde_estoque,
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
    $endereco_img = str_replace('\\', '/',$server_static.'empreendimentos/produtos/'.$endereco_img);
    }
    

    $results .=' 
            <tr>
                    <td ><font color="black"><b>'.$row->prod_id.'</b></font></td>
                    <td ><img style="width:50px;" src="'.$endereco_img.'"/></td>
                    <td><font color="black"><b>'.$row->prod_nome.'</b></font></td>
                    <td><font color="black"><b>'.$row->prod_marca.'</b></font></td>
                    <td><font color="black"><b>'.$row->prod_qtde_estoque.'</b></font></td>
                    <td><font color="black"><b>'.$row->prod_descricao.'</b></font></td>
                    <td><font color="black"><b>'.$row->prod_valor_total.'</b></font></td>
                    <!--td><font color="black"><b>'.$row->prod_promocao.'</b></font></td>
                    <td><font color="black"><b>'.$row->prod_valor_promocao.'</b></font></td-->
                    <td><font color="black"><b>'.$status.'</b></font></td>
                    <td><a class="btn" href="'.$server_static.'empreendimentos/produtos/atualizar_produtos.php?id='.$row->prod_id.'"><img src="../../static/icones/editar.png" style="width:20px;"/></a></td>
            </tr>';

        

//echo $results;
}
include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
//include_once ROOT_PATH."menu_footer/menu_empreendimento.php" ;
?>

<!DOCTYPE html>

<html>

<head>
    <!-- Tabela -->
    <link rel="stylesheet" href="https://code.jquery.com/jquery-3.3.1.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <!--link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css"-->

</head>
<?php
    
include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php" 
    
?>

<body>
<div >   
    <div class="main">
        <h2 align="center"><label style="margin-top:5%; margin-left:5%;" >Consulta Produtos</label></h2>

    <div class="table-responsive">
    <table id="produtos" class="table table-hover" style="width:100%">
        <thead>
            <tr style="background:#4fdc6f">
                <th style="color:white;">ID</th>
                <th style="color:white;">imagem</th>
                <th style="color:white;">Nome</th>
                <th style="color:white;">Marca</th>
                <th style="color:white;">Qtde Estoque</th>
                <th style="color:white;">Descrição</th>
                <th style="color:white;">Valor Total</th>
                <!--style="color:white;"th >Possuí Promoção ?</th>
                <th style="color:white;">Valor Promoção</th-->
                <th style="color:white;">Status</th>
                <th style="color:white;">Editar</th>
            </tr>
        </thead>
        <?php echo $results ?>
    </table>
    </div>

        <a class="btn btn-dark" href="../../empreendimentos/home_empreendimento.php"> Voltar</a>
        <a style="background:#4fdc6f; color:white;"  class="btn" href="<?php echo $server_static?>empreendimentos/produtos/cadastro_produtos.php">Cadastrar Produto</a>
        
    </div>
</div>
    
</body>



    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>




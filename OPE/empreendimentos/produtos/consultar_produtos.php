<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:54:22
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
    $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/produtos/'.$endereco_img);
    }
    

    $results .='<tr>
                    
                    <td>'.$row->prod_id.'</td>
                    <td><img src="'.$endereco_img.'" style="width:100%"/></td>
                    <td>'.$row->prod_nome.'</td>
                    <td>'.$row->prod_marca.'</td>
                    <td>'.$row->prod_qtde_estoque.'</td>
                    <td>'.$row->prod_descricao.'</td>
                    <td>'.$row->prod_valor_total.'</td>
                    <td>'.$row->prod_promocao.'</td>
                    <td>'.$row->prod_valor_promocao.'</td>
                    <td>'.$status.'</td>
                    
                    <td><a href="../../empreendimentos/produtos/atualizar_produtos.php?id='.$row->prod_id.'"</a> editar</td>
                </tr>';
//echo $results;
}
include_once("../../menu_footer/menu_empreendimento.php"); 
//include_once "../menu_footer/menu_empreendimento.php" ;
?>

<!DOCTYPE html>

<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../static/estilo.css">


</head>
<?php
    
include_once "../../menu_footer/menu_latera_empreendimento.php" 
    
?>
<body>
<div class="one_page home_empreendimento">
    <div class="main">
    <table class="table tabelas" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col" style="width:100%">imagem</th>
                <th scope="col">Nome</th>
                <th scope="col">Marca</th>
                <th scope="col">Qtde Estoque</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Possuí Promoção ?</th>
                <th scope="col">Valor Promoção</th>
                <th scope="col">Status</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <?php echo $results ?>
    </table>
    <a class="btn btn-dark" href="..\home_empreendimento.php"> Voltar</a>
       <a class="btn btn-success" href="../../empreendimentos/produtos/cadastro_produtos.php">Cadastrar Produtos</a>
    </div>
    </div>
    
</body>

<footer>

    <?php 
    include_once("../../menu_footer/footer.php");     
    ?>

</footer>


</html>
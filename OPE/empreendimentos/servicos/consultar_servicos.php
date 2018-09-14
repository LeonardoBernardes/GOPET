<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 01:53:43
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
            serv_id,
            serv_nome,
            serv_descricao,
            serv_valor_total,
            serv_promocao,
            serv_valor_promocao,
            serv_status
        FROM 
            `servicos` 
        WHERE 
            `empr_id` = '$row2->empr_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
while ($row = mysqli_fetch_object($result)) {

    if($row->serv_status == 0){
        $status = "DESATIVADO";
    }else{
        $status = "ATIVADO";
    }

    $sql3=" SELECT 
                seim_endereco
            FROM 
                servicos_imagens 
            WHERE 
                empr_id = $row2->empr_id
                AND serv_id = $row->serv_id";
    //echo $sql3;
    $result4 =  mysqli_query($conn, $sql3);
    $row5 = mysqli_fetch_object($result4);


    $endereco_img = '';
    if(!empty($row5)){
        $endereco_img = $row5->seim_endereco;
    }
    if(!empty($endereco_img)){
    //Criar Funcao para trazer local host como variavel
    $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/servicos/'.$endereco_img);
    }

    $results .='<tr>
                    <td>'.$row->serv_id.'</td>
                    <td><img src="'.$endereco_img.'" style="width:100%;"/></td>
                    <td>'.$row->serv_nome.'</td>
                    <td>'.$row->serv_descricao.'</td>
                    <td>'.$row->serv_valor_total.'</td>
                    <td>'.$row->serv_promocao.'</td>
                    <td>'.$row->serv_valor_promocao.'</td>
                    <td>'.$status.'</td>
                    
                    <td><a href="..\servicos\atualizar_servicos.php?id='.$row->serv_id.'"> Editar</a></td>
                </tr>';
//echo $results;
}
 include_once("../../menu_footer/menu_empreendimento.php"); 
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
    <title>Gopet</title>

</head>

<body>
   
<?php
    
include_once "../../menu_footer/menu_latera_empreendimento.php" 
    
?>
    <div  class="main">
    <h2 style="margin-top:10%;">
        <legend><b>Meus Funcionários</b></legend>
    </h2><br>
    <a class="btn btn-success"  href="http://localhost/PHP/GOPET/OPE/empreendimentos/servicos/cadastro_servicos.php">Cadastrar Serviços</a>
    <table class="table tabelas" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col" style="width:100%">imagem</th>
                <th scope="col">Nome</th>
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
    </div>
</body>

<footer>

    <?php 
    include_once("../../menu_footer/footer.php");     
    ?>

</footer>

</html>
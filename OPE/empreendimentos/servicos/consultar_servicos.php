<?php
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:49:39
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
    $endereco_img = str_replace('\\', '/',$server_static.'empreendimentos/servicos/'.$endereco_img);
    }

       $results .='
       <tr>
                            
                            <td ><font color="black"><b>'.$row->serv_id.'</b></font></td>
                            <td ><img style="width:50px;" src="'.$endereco_img.'"/></td>
                            <td><font color="black"><b>'.$row->serv_nome.'</b></font></td>
                            <td><font color="black"><b>'.$row->serv_descricao.'</b></font></td>
                            <td><font color="black"><b>'.$row->serv_valor_total.'</b></font></td>
                            <!--td><font color="black"><b>'.$row->serv_promocao.'</b></font></td>
                            <td><font color="black"><b>'.$row->serv_valor_promocao.'</b></font></td-->
                            <td><font color="black"><b>'.$status.'</b></font></td>
                            <td class="btn"><a href="'. $server_static.'empreendimentos/servicos/atualizar_servicos.php?id='.$row->serv_id.'"><img src="../../static/icones/editar.png" style="width:20px;"/></a></td>
                    </tr>
      ';
//echo $results;
}
 include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
 
?>

<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
    <title>GOPET</title>

</head>

<body>
   
<?php
    
include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php" 
    
?>
<div>   
    <div class="main">
        <h2><label style="margin-top:5%; margin-left:5%;" >Consulta Serviços</label></h2>

    <div class="table-responsive">
    <table class="table table-hover" style="width:100%">
        <thead >
            <tr class="bg-success">
                 <th scope="col">ID</th>
                <th scope="col" style="width:100%">imagem</th>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor Total</th>
                <!--th scope="col">Possuí Promoção ?</th>
                <th scope="col">Valor Promoção</th-->
                <th scope="col">Status</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <?php echo $results ?>
    </table>
    </div>

        <a class="btn btn-dark" href="../../empreendimentos/home_empreendimento.php"> Voltar</a>
        <a class="btn btn-success" href="<?php echo $server_static?>empreendimentos/servicos/cadastro_servicos.php">Cadastrar Serviço</a>
        
    </div>
</div>
</body>

<footer>

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>

</html>
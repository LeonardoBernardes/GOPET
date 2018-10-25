<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-24 21:00:41
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
if(isset($ids)){
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

        $sql3=" SELECT 
                    evim_endereco
                FROM 
                    eventos_imagens 
                WHERE 
                    even_id = $row->even_id";
        //echo $sql3;
        $result4 =  mysqli_query($conn, $sql3);
        $row5 = mysqli_fetch_object($result4);


        $endereco_img = '';
        if(!empty($row5)){
            $endereco_img = $row5->evim_endereco;
        }
        if(!empty($endereco_img)){
        //Criar Funcao para trazer local host como variavel
        $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/eventos/'.$endereco_img);
        }


        $results .='            
            <tr>
                    <td ><font color="black"><b>'.$row->even_id.'</b></font></td>
                    <td ><img style="width:50px;" src="'.$endereco_img.'"/></td>
                    <td><font color="black"><b>'.$row->even_nome.'</b></font></td>
                    <td><font color="black"><b>'.$row->even_descricao.'</b></font></td>
                    <td><font color="black"><b>'.$row->even_data_realizacao.'</b></font></td>
                    <td><font color="black"><b>'.$status.'</b></font></td>
                    <td class="btn"><a href="../eventos/atualizar_eventos.php?id='.$row->even_id.'"><img src="../../static/icones/editar.png" style="width:20px;"/></a></td>
            </tr>';

    }
}
 include_once("../../menu_footer/menu_empreendimento.php"); 
// include_once "../menu_footer/menu_empreendimento.php" ;
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
<?php
    
include_once "../../menu_footer/menu_latera_empreendimento.php" 
    
?>
<body>
<div>   
    <div class="main">
        <h2><label style="margin-top:5%;" >Consulta Produtos</label></h2>

    <div class="table-responsive">
    <table id="produtos" class="table table-hover" style="width:100%">
        <thead>
            <tr class="bg-success">
            <th scope="col">ID</th>
            <th scope="col">Imagem</th>
            <th scope="col">Nome</th>
            <th scope="col">Descrição</th>
            <th scope="col">Data de realização</th>
            <th scope="col">Status</th>
            <th scope="col">Editar</th>
            </tr>
        </thead>
        <?php echo $results ?>
    </table>
    </div>

   
        
    </div>
</div>
</body>

<footer>

    <?php 
    include_once("../../menu_footer/footer.php");     
    ?>

</footer>

</html>
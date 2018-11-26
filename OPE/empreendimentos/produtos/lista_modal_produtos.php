<?php 
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-10-03 23:37:04 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-10-04 20:15:07
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

$empr_id = ($_GET['empr_id']) ? $_GET['empr_id'] : ""; 
$results = '';

$sql = "SELECT 
            prod_id,
            prod_nome as nome,
            prod_marca as marca,
            prod_descricao as descricao,
            prod_valor_total as valor
        FROM 
            produtos 
        WHERE 
            empr_id =$empr_id 
            AND prod_qtde_estoque > 0 
            AND prod_status = 1 ";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_object($result)){

  //$arr_empreendimentos_JSON[$row->empr_id] = $row;
  $row->nome = (!empty($row->nome)) ? $row->nome : ' ';
  $row->marca = (!empty($row->marca)) ? $row->marca : ' ';
  $row->descricao = (!empty($row->descricao)) ? $row->descricao : ' ';
  $row->valor = (!empty($row->valor)) ? $row->valor : 0;

    $sql3=" SELECT 
                prim_endereco
            FROM 
                produtos_imagens 
            WHERE 
                empr_id = $empr_id
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
                <div class="card-group">
                    <div class="card">
                    <img class="card-img-top" src="'.$endereco_img.'" style="width:30%"/>
                    <div class="card-body">
                    <span for="inputGroupSelect01"><b>Nome:</b> '.$row->nome.'</span><br>
                    <span for="inputGroupSelect01"><b>Marca:</b> '.$row->marca.'</span><br>
                    <span for="inputGroupSelect01"><b>Descrição:</b> '.$row->descricao.'</span><br>
                    <span for="inputGroupSelect01"><b>Valor:</b> '.$row->valor.'</span><br>
                </div>
              </div>';

}
if(empty($results)){
    $results .='<div class="col-md-12">
                    <div class="col-md-12 card">
                        <span class="badge badge-warning" style="margin-top:15px; font-size:16px;">Esse empreendimento não possui <b>PRODUTOS</b> disponíveis para venda.</span><br>
                    </div>
                </div>';
}
//echo $results; 


?>

<div class="container">
    <div class="row">
      
        <?php echo $results ?>
       
        
 
    </div>
    
</div>

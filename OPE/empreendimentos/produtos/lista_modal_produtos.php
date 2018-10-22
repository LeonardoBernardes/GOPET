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
        $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/produtos/'.$endereco_img);
    }


  
  $results .='
                <div class="col-md-12">
                    <img src="'.$endereco_img.'" style="width:100%"/>
                    <span class="input-group-text" for="inputGroupSelect01">Nome: '.$row->nome.'</span><br>
                    <span class="input-group-text" for="inputGroupSelect01">Marca: '.$row->marca.'</span><br>
                    <span class="input-group-text" for="inputGroupSelect01">Descrição: '.$row->descricao.'</span><br>
                    <span class="input-group-text" for="inputGroupSelect01">Valor: '.$row->valor.'</span><br>
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

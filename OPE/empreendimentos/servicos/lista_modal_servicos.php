<?php 
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-10-03 23:37:04 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-10-04 20:26:59
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

$empr_id = ($_GET['empr_id']) ? $_GET['empr_id'] : ""; 
$results = '';

$sql = "SELECT 
            serv_id,
            serv_nome as nome,
            serv_descricao as descricao,
            serv_valor_total as valor
        FROM 
            servicos 
        WHERE 
            empr_id =$empr_id 
            AND serv_status = 1 ";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_object($result)){

  //$arr_empreendimentos_JSON[$row->empr_id] = $row;
  $row->nome = (!empty($row->nome)) ? $row->nome : ' ';
  $row->descricao = (!empty($row->descricao)) ? $row->descricao : ' ';
  $row->valor = (!empty($row->valor)) ? $row->valor : 0;

    $sql3=" SELECT 
                seim_endereco
            FROM 
                servicos_imagens 
            WHERE 
                empr_id = $empr_id
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
                <div class="bg-light p-4 m-1 border col-md-12 rounded">
                    <div class="col-md-3">
                        <img class="img-fluid" src="'.$endereco_img.'" />
                    </div>
                    <div class="col-md-9">
                        <span>Nome: '.$row->nome.'</span><br/>
                        <span>Valor: '.$row->valor.'</span><br/>
                        <span>Descrição: '.$row->descricao.'</span>
                    </div>
                </div>';

}
if(empty($results)){
    $results .='<div class="col-md-12">
                    <div class="col-md-12 card">
                        <span class="badge badge-warning" style="margin-top:15px; font-size:16px;">Esse empreendimento não possui <b>SERVIÇOS</b> disponíveis.</span><br>
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




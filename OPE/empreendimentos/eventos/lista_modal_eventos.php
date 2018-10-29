<?php 
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-10-03 23:37:04 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-10-04 20:31:16
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

$empr_id = ($_GET['empr_id']) ? $_GET['empr_id'] : ""; 
$results = '';


//Pega todos os eventos  daquele empreendimento
$sql2 = "SELECT
            even_id
        FROM
            empreendimentos_x_eventos
        WHERE
            empr_id  = $empr_id   
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
        $endereco_img = str_replace('\\', '/',$server_static.'empreendimentos/eventos/'.$endereco_img);
        }

  
        $results .='<div class="col-md-12 bg-light p-4">
                        <div class="col-md-6">
                            <!--div class="form-row"-->
                                <!--div class="col"-->
                                    <img src="'.$endereco_img.'" style="width:100%"/>
                                <!--/div-->
                                
                            <!--/div-->
                        </div>
                        <div class="col-md-6">
                            <!--div class="form-row"-->
                                <div class="col">
                                    <span for="inputGroupSelect01">Nome: '.$row->even_nome.'</span><br>
                                </div>
                                <div class="col">
                                    <span for="inputGroupSelect01">Descrição: '.$row->even_descricao.'</span><br>
                                    <span for="inputGroupSelect01">Status: '.$row->even_status.'</span><br>
                                </div>
                                <div class="col">
                                    <span for="inputGroupSelect01">Data da Realização: '.$row->even_data_realizacao.'</span><br>
                                </div>
                            <!--/div-->
                        </div>
                            
                    </div>
                    ';
    }
}
if(empty($results)){
    $results .='<div class="col-md-12">
                    <div class="col-md-12 card">
                        <span class="badge badge-warning" style="margin-top:15px; font-size:16px;">Esse empreendimento não possui <b>EVENTOS</b> disponíveis.</span><br>
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




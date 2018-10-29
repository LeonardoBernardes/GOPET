<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-10-03 23:37:04 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-10-04 20:41:46
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
$empr_id = ($_GET['empr_id']) ? $_GET['empr_id'] : ""; 
$results = '';
$endereco_img = '';
$sql3 ="SELECT
            anim_id,
            eman_flag
        FROM
            empreendimentos_x_animais 
        WHERE
            empr_id = $empr_id";
    //echo $sql3;
$result = mysqli_query($conn, $sql3);

while($row = mysqli_fetch_object($result)){
    if(!empty($row)){
        if(!isset($ids)){
            $ids = $row->anim_id;
        }
        $ids = $ids.",".$row->anim_id;
    }
}
if(isset($ids)){
    $sql="  SELECT 
                anim_id,
                anim_nome,
                anim_ra,
                anim_idade,
                anim_porte,
                anim_genero,
                anim_categoria,
                anim_restricao_doacao,
                anim_castracao
            FROM 
                `animais` 
            WHERE 
                `anim_id` in ($ids)
            ";
    //echo $sql;
    //break;
    $result =  mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_object($result)) {
        
        if($row->anim_castracao == 0){
            $castracao = "Não";
        }elseif($row->anim_castracao == 1){
            $castracao = "Sim";
        }else{
            $castracao = "Não indentificado";
        }

        $sql3=" SELECT 
                    anim_id,
                    anfo_endereco
                FROM 
                    animais_fotos 
                WHERE 
                    anim_id in ($ids)";
        //echo $sql3;

        $result4 =  mysqli_query($conn, $sql3);
        while($row5 = mysqli_fetch_object($result4)){
    
    
        
        if(!empty($row5)){

            if($row5->anim_id == $row->anim_id){
                $endereco_img = $row5->anfo_endereco;
            }
        }
    }
        if(!empty($endereco_img)){
        //Criar Funcao para trazer local host como variavel
        $endereco_img = str_replace('\\', '/',$server_static.'animais/'.$endereco_img);
        }
        $results .='
                <div class="bg-light p-4 col-md-12">
                    <div class="form-row">
                        <div class="col">
                        <img style="width:200px;" src="'.$endereco_img.'" style="width:100%"/>
                        </div>
                        <div class="col">
                        <span style="color:"#33cc00;" for="inputGroupSelect01"><h2><b> Nome: </b> '.$row->anim_nome.'<h2></span><br>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                        <span for="inputGroupSelect01"><b>RGA:</b> '.$row->anim_ra.'</span><br>
                        </div>
                        <div class="col">
                        <span for="inputGroupSelect01"><b>Idade:</b>'.$row->anim_idade.'</span><br>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                        <span for="inputGroupSelect01"><b>Porte: </b>'.$row->anim_porte.'</span><br>
                        </div>
                        <div class="col">
                        <span for="inputGroupSelect01"><b>Gênero: </b>'.$row->anim_genero.'</span><br>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                        <span for="inputGroupSelect01"><b> Categoria: </b>'.$row->anim_categoria.'</span><br>
                        </div>
                        <div class="col">
                        <span for="inputGroupSelect01"><b> Restrição de adoção: </b>'.$row->anim_restricao_doacao.'</span><br>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col">
                        <span for="inputGroupSelect01"><b> Castrado ? </b>'.$castracao.'</span><hr>
                        </div>
                    </div>  
                </div>            
            ';
    
    //echo $results;
    }
}
if(empty($results)){
    $results .='<div class="col-md-12">
                    <div class="col-md-12 card">
                        <span class="badge badge-warning" style="margin-top:15px; font-size:16px;">Esse empreendimento não possui <b>ANIMAIS</b> disponíveis.</span><br>
                    </div>
                </div>';
}


?>

<div class="container">
    <div class="row">
      
        <?php echo $results ?>
       
        
 
    </div>
    
</div>

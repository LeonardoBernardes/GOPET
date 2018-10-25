<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-10-03 23:37:04 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-10-04 20:41:46
 */

include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');

session_start();
    
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
          unset($_SESSION);
            //unset($_SESSION['login']);
            //unset($_SESSION['senha']);
            //unset($_SESSION['grup_id']);
            header('location:index.php');
        }

//$empr_id = ($_GET['empr_id']) ? $_GET['empr_id'] : ""; 
$results = '';
$endereco_img = '';
$sql3 ="SELECT 
            ANIM_ID.ANIM_ID,
            ANIM_ID.ANIM_NOME AS NOME,
            USAN.usan_flag,
            EMAN.eman_flag,
            anem.anen_logradouro as logradouro,
            anem.anen_numero as numero,
            anem.anen_bairro as bairro,
            anem.anen_cidade as cidade,
            anem.anen_estado as estado,
            anem.anen_pais as pais,
            anem.anen_cep as cep,
            anem.anen_complemento as complemento,
            anem.anen_data_cadastro as data_cadastro,
            anem.anen_data_atualizacao as data_atualizacao,
            anfo.anfo_endereco as endereco_img
        FROM 
            ANIMAIS ANIM_ID 
            LEFT JOIN usuarios_x_animais USAN ON ANIM_ID.ANIM_ID = USAN.ANIM_ID
            LEFT JOIN empreendimentos_x_animais EMAN ON ANIM_ID.ANIM_ID = EMAN.ANIM_ID
            LEFT JOIN animais_endereco anem ON ANIM_ID.ANIM_ID = anem.anim_id
            LEFT JOIN animais_fotos anfo ON ANIM_ID.ANIM_ID = anfo.anim_id
        WHERE 
            anem.anen_logradouro is NOT NULL
            AND anfo.anfo_endereco is NOT NULL
         --   AND anem.anen_logradouro <> ''
         --   AND anfo.anfo_endereco <> ''";
    //echo $sql3;
    //return;
$result = mysqli_query($conn, $sql3);
while($row = mysqli_fetch_object($result)){
    if(!empty($row)){
      
        
        if(!empty($row->endereco_img)){
            $endereco_img = $row->endereco_img;
        }else{
            $endereco_img = '';
        }
            

        if(!empty($endereco_img)){
            //Criar Funcao para trazer local host como variavel
            $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/animais/'.$endereco_img);
        }

        //if(!empty($row->usan_flag) || !empty($row->eman_flag)){
        //    
        //}


$results .='    <div class="main">
                    <div class="container login-empreendimento">
                        <fieldset id="fie">
                            <img style="width:200px;" src="'.$endereco_img.'" style="width:100%"/>
                            <span for="inputGroupSelect01">Nome: '.$row->NOME.'</span>
                            <div class="form-row">
                            <div class="col">                           
                            <span  for="inputGroupSelect01">Data de Cadastro: '.$row->data_cadastro.'</span>
                            </div>
                            <div class="col">                            
                            <span  for="inputGroupSelect01">Data de Atualizaçao: '.$row->data_atualizacao.'</span><br>
                            </div>
                            </div>     
                            <div class="form-row">
                            <div class="col">
                            <span  for="inputGroupSelect01">Logradouro: '.$row->logradouro.'</span>
                            </div>
                            <div class="col">
                            <span for="inputGroupSelect01">Número: '.$row->numero.'</span>
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="col">
                            <span  for="inputGroupSelect01">Complemento: '.$row->complemento.'</span>
                            </div>
                            <div class="col">
                            <span for="inputGroupSelect01">Bairro: '.$row->bairro.'</span>
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="col">
                            <span  for="inputGroupSelect01">Cidade: '.$row->cidade.'</span>
                            </div>
                            <div class="col">
                            <span  for="inputGroupSelect01">Estado: '.$row->estado.'</span>
                            </div>
                            </div>
                            <div class="form-row">
                            <div class="col">                            
                            <span  for="inputGroupSelect01">Pais: '.$row->pais.'</span>
                            </div>
                            <div class="col">                            
                            <span  for="inputGroupSelect01">CEP: '.$row->cep.'</span>
                            </div>
                            </div>                       
                            
                        </fieldset>
                    </div>
                </div>        
            ';
    
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
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/estilo.css">


</head>


<!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&libraries=places"></script-->
<body>

<?php
if ($_SESSION['grup_id'] == 4){
    include_once("../menu_footer/menu_empreendimento.php"); 
    include_once("../menu_footer/menu_latera_empreendimento.php");
    }
    if ($_SESSION['grup_id'] == 1){    
    include_once("../menu_footer/menu_administrador.php");
    }
    if ($_SESSION['grup_id'] == 3){    
    include_once("../menu_footer/menu_usuario.php");
    include_once("../menu_footer/menu_latera_usuario.php");
    }
?>    
<div id="formulario_empreendimento">
        <?php echo $results ?>
    </div>
</body>
     <!-- The Modal -->
     <div class="modal modal" id="myModal" style="width:100%;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
          
            <!-- Modal Header -->
            <div class="modal-header">
              <h4 class="modal-title">Modal Heading</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            
            <!-- Modal body -->
            <div class="modal-body">
              Modal body..
            </div>
            
            <!-- Modal footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            
          </div>
        </div>
      </div>
     <!-- Optional JavaScript -->
      <!--script src="static/jquery.js"></script>
      <script src="static/bootstrap/js/bootstrap.js"></script-->
    
    
    <!--Verificar quais já possui no projeto e se não possuir baixar  -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<footer>

<?php 
include_once("../menu_footer/footer.php");     
?>

</footer>

</html>

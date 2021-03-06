<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-10-03 23:37:04 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-10-04 20:41:46
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

session_start();
    
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
          unset($_SESSION);
            //unset($_SESSION['login']);
            //unset($_SESSION['senha']);
            //unset($_SESSION['grup_id']);
            header('location:'.$server_static.'index.php');
        }

//$empr_id = ($_GET['empr_id']) ? $_GET['empr_id'] : ""; 
$results = '';
$endereco_img = '';
$favoritar = '';

if(isset($_GET['tipo_filtro']) && (isset($_GET['filtro_animal']) || isset($_GET['filtro_endereco'])) ){

    $tp_filtro = (!empty($_GET['tipo_filtro'])) ? $_GET['tipo_filtro'] : "";
    $filtro_animal = (!empty($_GET['filtro_animal'])) ? $_GET['filtro_animal'] : "";
    
    // configuração filtro endereco
    $texto_filtro = (!empty($_GET['filtro_endereco'])) ? $_GET['filtro_endereco'] : "";
    if(!empty($texto_filtro)){
      $texto_filtro = rtrim($texto_filtro);
      $texto_filtro = ltrim($texto_filtro);
      if((substr_count($texto_filtro,"/")) == 1){
  
  
        $arr = explode("/",$texto_filtro);
        $cidade = $arr[0];
        $bairro = $arr[1];
  
      }elseif((substr_count($texto_filtro,"/")) > 1){
        $arr = explode("/",$texto_filtro);
        $cidade = $arr[0];
        $bairro = $arr[1];
        $rua = $arr[2];
      }
      elseif((substr_count($texto_filtro,"/")) == 0 ){
        // echo"teste";
        // return;
        $cidade = $texto_filtro;
      }
      
      
    //return;
    }
}
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
            ( 
                (USAN.usan_flag = 2 OR USAN.usan_flag = 1)  
                    OR 
                (EMAN.eman_flag = 2 OR EMAN.eman_flag = 1)
            )
            AND anem.anen_logradouro is NOT NULL
            AND anfo.anfo_endereco is NOT NULL
";
   
    if(!empty($tp_filtro) && $tp_filtro == 'animal'){
        if(!empty($filtro_animal)){
            $sql3 .=" AND ANIM_ID.anim_categoria LIKE '$filtro_animal' ";
        
        }
      }
      if(!empty($tp_filtro) && $tp_filtro == 'endereco'){
        if(!empty($texto_filtro)){
          if(isset($cidade)){
            $sql3 .=" AND anem.anen_cidade LIKE '%$cidade%' ";
          }
          if(isset($bairro)){
            $sql3 .=" AND anem.anen_bairro LIKE '%$bairro%' ";
          }
          if(isset($rua)){
            $sql3 .=" AND anem.anen_logradouro LIKE '%$rua%' ";
          }
        
        
        }
      }
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
            $endereco_img = str_replace('\\', '/',$server_static.'animais/'.$endereco_img);
        }
if($_SESSION['grup_id'] == 3){
    $favoritar ="<button onclick='favoritar()' class='btn btn-success btn-sm' style='margin-left:10%;'>Favoritar</button>";
}

$results .='<div class="main" style="margin-top:-10%; ">
                <div class="container login-empreendimento">
                    <fieldset id="fie">
                        <img style="width:200px;" src="'.$endereco_img.'" style="width:100%"/>
                        <span for="inputGroupSelect01">Nome: '.$row->NOME.'</span>
                        '.$favoritar.'
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
            </div>';

    }
}
if(empty($results)){
    $results .='<div class="col-md-12">
                    <div class="col-md-12 card">
                        <span class="badge badge-warning" style="margin-top:10%; font-size:16px;">Não encontramos animais com esses filtros.</span><br>
                    </div>
                </div>';
}
if ($_SESSION['grup_id'] == 4){
    include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
    }
    if ($_SESSION['grup_id'] == 1){    
        include_once(ROOT_PATH."menu_footer/menu_administrador.php");
    }
    if ($_SESSION['grup_id'] == 3){    
        include_once(ROOT_PATH."menu_footer/menu_usuario.php");
    }

?>

<!DOCTYPE html>
<html>

<head>
      <!-- Optional JavaScript -->
      <script src="<?php echo $server_static?>static/jquery.js"></script>
    <script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script>
   
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
 
    <style>

        .hide{
        display:none;
        }
        .show{
        display:true;
        }
    </style>
</head>

<body>

    <?php
        if ($_SESSION['grup_id'] == 4){
        include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
        }
        if ($_SESSION['grup_id'] == 3){    
            include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
        }
    ?>    
    <div id="formulario_empreendimento" style="margin-top:13%; ">
        <div class="col-md-6 fixed-top" style="margin-left:40%; margin-top: 65px;">
            <form name="form" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>" >
                <div class="input-group input-group-sm"  style="margin-left:10%;">
                    <div class="input-group-prepend">
                        <span class="input-group-text bg-primary" style="color:white;">Filtrar por:</span>
                    </div>
                    <select  class="form-control col-md-3"  name="tipo_filtro" id="tipo_filtro">
                        <option value="animal" <?php if(isset($tp_filtro) && $tp_filtro == 'animal'){ echo 'Selected'; }  ?> >ANIMAL</option>
                        <option value="endereco" <?php if(isset($tp_filtro) && $tp_filtro == 'endereco'){ echo 'Selected'; } ?>>ENDEREÇO</option>
                    </select> 
                    <select  class="form-control col-md-4" name="filtro_animal" id="tipo_filtro_animal">          
                        <option value="cachorro" <?php if(isset($filtro_animal) && $filtro_animal == 'cachorro'){ echo 'Selected'; }  ?>>CACHORROS</option>
                        <option value="coelho" <?php if(isset($filtro_animal) && $filtro_animal == 'coelho'){ echo 'Selected'; }  ?>>COELHOS</option>
                        <option value="gato" <?php if(isset($filtro_animal) && $filtro_animal == 'gato'){ echo 'Selected'; }  ?>>GATOS</option>
                        <option value="hamster" <?php if(isset($filtro_animal) && $filtro_animal == 'hamster'){ echo 'Selected'; }  ?>>HAMSTERS</option>
                    </select> 
                    <input class="form-control col-md-10 hide" type="text" name="filtro_endereco" id="filtro_endereco"  placeholder="Digite o endereço. ( Cidade*/Bairro/Logradouro)" value="<?php if(isset($texto_filtro) && !empty($texto_filtro)){ echo $texto_filtro; } ?>"> 
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary" id="btn_filtro" name="btn_filtro">
                            Filtrar
                        </button>
                    </div>
                </div>  
            </form>
        </div>


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
    
    <!--Verificar quais já possui no projeto e se não possuir baixar  -->
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
 <script>
    var name_filtro = $('#tipo_filtro option:selected').val();
    if(name_filtro != ''){
        if(name_filtro == 'animal'){
            $("#tipo_filtro_animal").addClass('show');
            $("#tipo_filtro_animal").removeClass('hide');
            $("#filtro_endereco").addClass('hide');
            $("#filtro_endereco").removeClass('show');
        }else{
            $("#filtro_endereco").addClass('show');
            $("#filtro_endereco").removeClass('hide');
            $("#tipo_filtro_animal").addClass('hide');
            $("#tipo_filtro_animal").removeClass('show');
            
        }
    }
    $("#tipo_filtro").change(function() {
        var tp_filtro = $("#tipo_filtro").val();

        if(tp_filtro != ''){
            if(tp_filtro == "animal"){
            $("#tipo_filtro_animal").addClass('show');
            $("#tipo_filtro_animal").removeClass('hide');
            $("#filtro_endereco").addClass('hide');
            $("#filtro_endereco").removeClass('show');
            }else{
            $("#filtro_endereco").addClass('show');
            $("#filtro_endereco").removeClass('hide');
            $("#tipo_filtro_animal").addClass('hide');
            $("#tipo_filtro_animal").removeClass('show');
            }
        }

    });

function favoritar(){
    window.location.href="<?php echo $server_static?>usuarios/favoritos_animais.php";
}


</script>

<footer>

<?php 
include_once(ROOT_PATH."menu_footer/footer.php");     
?>

</footer>

</html>

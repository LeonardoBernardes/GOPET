<?php 
include_once '../config/server.php';
/*
 * @Author: Rafael Yuiti Haga
 * @Date: 2018-09-12 19:55:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-11-08 20:23:38
 */
    include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';
    session_start();
    
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
          unset($_SESSION);
            //unset($_SESSION['login']);
            //unset($_SESSION['senha']);
            //unset($_SESSION['grup_id']);
            header('location:'.$server_static.'index.php');
        }
     
    $logado = $_SESSION['login'];
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    $castracao = '';
    $results = "";
    $arr_empreendimentos = array();
    if(isset($_GET['tipo_filtro']) &&  isset($_GET['filtro_endereco']) ){

      $tp_filtro = (!empty($_GET['tipo_filtro'])) ? $_GET['tipo_filtro'] : "";
      
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
    $sql = "SELECT 
              empreendimentos_enderecos.emen_id AS id,
              empreendimentos.empr_id AS empr_id,
              empreendimentos.empr_nome AS nome,
              empreendimentos.empr_slogan AS slogan,
              empreendimentos_enderecos.emen_logradouro AS logradouro,
              empreendimentos_enderecos.emen_numero AS numero,
              empreendimentos_enderecos.emen_complemento as complemento,
              empreendimentos_enderecos.emen_estado AS estado,
              empreendimentos_enderecos.emen_cidade AS cidade,
              empreendimentos_enderecos.emen_bairro AS bairro,
              empreendimentos_enderecos.emen_pais AS pais,
              empreendimentos_enderecos.emen_cep AS cep,
              empreendimentos_enderecos.emen_longitude AS latitude,
              empreendimentos_enderecos.emen_latitude AS longitude,
              empreendimentos_imagens.emim_endereco AS imagem
            FROM
                login
                    INNER JOIN
                login_x_empreendimentos ON (login.logi_id = login_x_empreendimentos.logi_id)
              INNER JOIN
                empreendimentos ON (login_x_empreendimentos.empr_id = empreendimentos.empr_id)
              INNER JOIN
                empreendimentos_enderecos ON (empreendimentos_enderecos.empr_id = empreendimentos.empr_id)
              INNER JOIN
                empreendimentos_imagens ON (empreendimentos_enderecos.empr_id = empreendimentos_imagens.empr_id)
            WHERE
                login.logi_status = 1
    ";
 //echo $sql;
    if(!empty($tp_filtro) && $tp_filtro == 'endereco'){
      if(!empty($texto_filtro)){
        if(isset($cidade)){
          $sql .=" AND empreendimentos_enderecos.emen_cidade LIKE '%$cidade%' ";
        }
        if(isset($bairro)){
          $sql .=" AND empreendimentos_enderecos.emen_bairro LIKE '%$bairro%' ";
        }
        if(isset($rua)){
          $sql .=" AND empreendimentos_enderecos.emen_logradouro LIKE '%$rua%' ";
        }
      
      
      }
    }
//echo $sql;
//return;
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($result)){

      $arr_empreendimentos_JSON[$row->empr_id] = $row;
      $row->nome = ($row->nome != 0 || !empty($row->nome)) ? $row->nome : ' ';
      $row->logradouro = ($row->logradouro != 0 || !empty($row->logradouro)) ? $row->logradouro : ' ';
      $row->numero = ($row->numero != 0 || !empty($row->numero)) ? $row->numero : ' ';
      $row->complemento = ($row->complemento != 0 || !empty($row->complemento)) ? $row->complemento : ' ';
      $row->cep = ($row->cep != 0 || !empty($row->cep)) ? $row->cep : ' ';
      $row->pais = ($row->pais != 0 || !empty($row->pais)) ? $row->pais : ' ';
      $row->estado = ($row->estado != 0 || !empty($row->estado)) ? $row->estado : ' ';
      $row->cidade = ($row->cidade != 0 || !empty($row->cidade)) ? $row->cidade : ' ';
      $row->bairro = ($row->bairro != 0 || !empty($row->bairro)) ? $row->bairro : ' ';
      $endereco_img = (!empty($row->imagem)) ? $row->imagem : '';

      if(!empty($endereco_img)){
        //Criar Funcao para trazer local host como variavel
        $endereco_img = str_replace('\\', '/',$server_static.'empreendimentos/'.$endereco_img);
      }
      if($_SESSION['grup_id'] == 3){
        $favoritar ="<button onclick='favoritar()' class='btn btn-success btn-sm' style='margin-left:10%;'>Favoritar</button>";
    }
      $results .='
      <div class="main"  style="margin-top:-10%;">
      <div class="container login-empreendimento">
              <fieldset id="fie">
                    <img style="width:150px;" src="'.$endereco_img.'" style="width:100% class="img-thumbnail""/>
                    <span for="inputGroupSelect01"><b>Nome</b>: '.$row->nome.'</span>
                    '.$favoritar.'
                    <div class="form-row">
                          <div class="col">    
                    <span  for="inputGroupSelect01"><b>Logradouro</b>: '.$row->logradouro.'</span>
                    </div>
                    <div class="col">
                    <span  for="inputGroupSelect01"><b>Número</b>: '.$row->numero.'</span>
                    </div>
                    </div> 
                    <div class="form-row">
                          <div class="col">    
                    <span  for="inputGroupSelect01"><b>Complemento</b>: '.$row->complemento.'</span>
                    </div>
                    <div class="col">
                    <span  for="inputGroupSelect01"><b>CEP</b>: '.$row->cep.'</span>
                    </div>
                    </div> 
                    <div class="form-row">
                    <div class="col">    
                    <span  for="inputGroupSelect01"><b>País</b>: '.$row->pais.'</span>
                    </div>
                    <div class="col">
                    <span  for="inputGroupSelect01"><b>Estado</b>: '.$row->estado.'</span>
                    </div>
                    </div> 
                    <div class="form-row">
                      <div class="col">    
                    <span  for="inputGroupSelect01"><b>Cidade</b>: '.$row->cidade.'</span>
                    </div>
                    <div class="col">
                    <span for="inputGroupSelect01"><b>Bairro</b>: '.$row->bairro.'</span><hr>
                    </div>
                    </div> 
                    <button id="animais/'.$row->empr_id.'" class="btn sticky-top" style="background:#4fdc6f; color:white;" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Animais" title="Animais" value="'.$row->empr_id.'" onclick="getId(this)">Animais</button>
                    <button id="eventos/'.$row->empr_id.'"   class="btn sticky-top" style="background:#4fdc6f; color:white;" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Eventos" title="Eventos" value="'.$row->empr_id.'" onclick="getId(this)">Eventos</button>
                    <button id="produtos/'.$row->empr_id.'"   class="btn sticky-top" style="background:#4fdc6f; color:white;" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Produtos" title="Produtos" value="'.$row->empr_id.'" onclick="getId(this)">Produtos</button>
                    <button id="servicos/'.$row->empr_id.'"   class="btn sticky-top" style="background:#4fdc6f; color:white;" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Serviços" title="Serviços" value="'.$row->empr_id.'" onclick="getId(this)">Serviços</button>
                   </fieldset>
          </div>
</div>
';

    }
    json_encode($arr_empreendimentos_JSON);
    

   if ($_SESSION['grup_id'] == 4){
    include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
    //include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
    }
    if ($_SESSION['grup_id'] == 1){    
    include_once(ROOT_PATH."menu_footer/menu_administrador.php");
    }
    if ($_SESSION['grup_id'] == 3){    
    include_once(ROOT_PATH."menu_footer/menu_usuario.php");
    //include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
    }
 
    ?>
    <script src="<?php echo $server_static;?>static/jquery.js"></script>
    <script src="<?php echo $server_static;?>static/bootstrap/js/bootstrap.js"></script>
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">


</head>


<!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&libraries=places"></script-->
<body>
<?php

if ($_SESSION['grup_id'] == 4){
 // include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
  include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
  }
  
  if ($_SESSION['grup_id'] == 3){    
  //include_once(ROOT_PATH."menu_footer/menu_usuario.php");
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
              <option value="endereco" <?php if(isset($tp_filtro) && $tp_filtro == 'endereco'){ echo 'Selected'; } ?>>ENDEREÇO</option>
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
 <!-- Optional JavaScript -->
  <!--script src="static/jquery.js"></script>
  <script src="static/bootstrap/js/bootstrap.js"></script-->


<!--Verificar quais já possui no projeto e se não possuir baixar  -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script>
      function getId(el){
        var id_button = el.id;
        var str = id_button.split("/",1);
        var str2 = id_button.substring(id_button.indexOf("/") + 1);


        if(str == 'eventos'){
         
              $.ajax({
                  type: 'GET',
                  url: 'eventos/lista_modal_eventos.php?empr_id='+str2,
                  success: function (data) {
                      //$('#popup').html(data);
                      //$('#popup').show();
                      $('.modal-body').html(data)
                      
                    
                  }
              });
          //});
        }else if(str == 'produtos'){
          $.ajax({
                  type: 'GET',
                  url: 'produtos/lista_modal_produtos.php?empr_id='+str2,
                  success: function (data) {
                      //$('#popup').html(data);
                      //$('#popup').show();
                      $('.modal-body').html(data)
                      
                    
                  }
              });
        }else if(str == 'servicos'){
          $.ajax({
                  type: 'GET',
                  url: 'servicos/lista_modal_servicos.php?empr_id='+str2,
                  success: function (data) {
                      //$('#popup').html(data);
                      //$('#popup').show();
                      $('.modal-body').html(data)
                      
                    
                  }
              });
        }
        else if(str == 'animais'){
          $.ajax({
                  type: 'GET',
                  url: '../animais/lista_modal_animais.php?empr_id='+str2,
                  success: function (data) {
                      //$('#popup').html(data);
                      //$('#popup').show();
                      $('.modal-body').html(data)
                      
                    
                  }
              });
        }

       
      }

        $('#myModal').on('show.bs.modal', function (event) {
                     
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          
          var modal = $(this)
          modal.find('.modal-title').text(recipient)
          modal.find('.modal-body input').val(recipient)
          
        })
        function favoritar(){
    window.location.href="<?php echo $server_static?>usuarios/favoritos_empreendimentos.php";
}
</script>

<footer>

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>

</html>
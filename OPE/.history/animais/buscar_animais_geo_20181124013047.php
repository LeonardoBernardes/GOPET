<?php 
include_once '../config/server.php';
/*
 * @Author: Rafael Yuiti Haga
 * @Date: 2018-09-12 19:55:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-18 20:22:43
 */
include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';
session_start();
$json_a = '';
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.'index.php');
    }
  
$logado = $_SESSION['login'];
$logi_id = $_SESSION['logi_id'];
$grup_id = $_SESSION['grup_id'];
    
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
}else{
  
}


$castracao = '';
$results = "";
$arr_animais = array();

    $sql = "SELECT 
                animais.anim_id AS id,
                animais.anim_nome AS nome,
                animais.anim_idade AS idade,
                animais.anim_porte AS porte,
                animais.anim_genero AS genero,
                animais.anim_categoria AS categoria,
                animais.anim_restricao_doacao AS restricao,
                animais.anim_castracao AS castracao,
                animais_fotos.anfo_endereco AS imagem,
                animais_endereco.anen_logradouro AS endereco,
                animais_endereco.anen_numero AS numero,
                animais_endereco.anen_logradouro AS complemento,
                animais_endereco.anen_pais AS pais,
                animais_endereco.anen_estado AS estado,
                animais_endereco.anen_cidade AS cidade,
                animais_endereco.anen_bairro AS bairro,
                animais_endereco.anen_cep AS cep,
                animais_endereco.anen_longitude AS latitude,
                animais_endereco.anen_latitude AS longitude,
                usuarios_x_animais.usan_flag as flag_usua_anim,
                empreendimentos_x_animais.eman_flag as flag_empr_anim
            FROM
                animais
                    INNER JOIN
                animais_fotos ON (animais.anim_id = animais_fotos.anim_id)
                    INNER JOIN
                animais_endereco ON (animais.anim_id = animais_endereco.anim_id)
                LEFT JOIN
              usuarios_x_animais ON (usuarios_x_animais.anim_id = animais.anim_id)
                LEFT JOIN
              empreendimentos_x_animais ON (empreendimentos_x_animais.anim_id = animais.anim_id)
            WHERE
               ( (usuarios_x_animais.usan_flag = 2 OR usuarios_x_animais.usan_flag = 1)  
                OR (empreendimentos_x_animais.eman_flag = 2 OR empreendimentos_x_animais.eman_flag = 1))";

    if(!empty($tp_filtro) && $tp_filtro == 'animal'){
      if(!empty($filtro_animal)){
          $sql .=" AND animais.anim_categoria LIKE '$filtro_animal' ";
      
      }
    }
    if(!empty($tp_filtro) && $tp_filtro == 'endereco'){
      if(!empty($texto_filtro)){
        if(isset($cidade)){
          $sql .=" AND animais_endereco.anen_cidade LIKE '%$cidade%' ";
        }
        if(isset($bairro)){
          $sql .=" AND animais_endereco.anen_bairro LIKE '%$bairro%' ";
        }
        if(isset($rua)){
          $sql .=" AND animais_endereco.anen_logradouro LIKE '%$rua%' ";
        }
      
      
      }
    }


 //  echo $sql;
 //  return;

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($result)){

      //valor restrição doação nulo
      if(empty($row->restricao)){
        $restr="Não Possui";
      }
      else{
        $restr=$row->restricao;
      }

      //Valor castração
      if($row->anim_castracao = 1)
      {
        $castracao = "Sim";

      }
      elseif($row->anim_castracao = 0){
      
        $castracao = "Não";
      }else{
        $castracao = "Não informado";
      }

      //validação de imagem no cadastro
      if(!empty($row->imagem)){
        $endereco_img = $row->imagem;
      }

      $arr_animais[$row->id] = [
        "nome" => ($row->nome) ? $row->nome : "teste",
        "idade"=> ($row->idade) ? $row->idade : 0,
        "porte"=> ($row->porte) ? $row->porte : "teste",
        "genero"=> ($row->genero) ? $row->genero : "teste",
        "categoria"=> ($row->categoria) ? $row->categoria : "teste",
        "restricao"=> ($restr) ? $restr : "teste",
        "castracao"=> ($castracao)? $castracao : "teste",
        "imagem"=>(str_replace('\\', '/',$server_static.'animais/'.$endereco_img)) ? str_replace('\\', '/',$server_static.'animais/'.$endereco_img) : "teste",
        "endereco" => ($row->endereco) ? $row->endereco : "teste",
        "numero" => ($row->numero) ? $row->numero : "teste",
        "complemento" => ($row->complemento) ? $row->complemento : "teste",
        "estado" => ($row->estado) ? $row->estado : "teste",
        "cidade" => ($row->cidade) ? $row->cidade : "teste",
        "bairro" => ($row->bairro) ? $row->bairro : "teste",
        "cep" => ($row->cep) ? $row->cep : "teste",
        "latitude" => (floatVal($row->latitude)) ? floatVal($row->latitude) : "0",
        "longitude" =>( floatVal($row->longitude))? floatVal($row->longitude) : "0"
      ];

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
<!-- Optional JavaScript -->    
<script src="<?php echo $server_static?>static/jquery.js"></script> 
<script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script> 
<!DOCTYPE html>
<html>

<head>
    <!-- Criador de objeto marker no google maps -->
    <script>
      var markers =
        [
          //cria um array em js de objetos de empreendimentos
          <?php

            foreach($arr_animais as $empr){
              echo '{ 
                      nome:"'.$empr['nome'].'", 
                      idade:'.$empr['idade'].', 
                      porte:"'.$empr['porte'].'", 
                      genero:"'.$empr['genero'].'", 
                      categoria:"'.$empr['categoria'].'", 
                      restricao:"'.$empr['restricao'].'", 
                      castracao:"'.$empr['castracao'].'", 
                      imagem:"'.$empr['imagem'].'", 
                      endereco:"'.$empr['endereco'].'", 
                      numero:"'.$empr['numero'].'", 
                      complemento:"'.$empr['complemento'].'", 
                      estado:"'.$empr['estado'].'", 
                      cidade:"'.$empr['cidade'].'", 
                      bairro:"'.$empr['bairro'].'", 
                      cep:"'.$empr['cep'].'", 
                      latitude:'.$empr['longitude'].',
                      longitude:'.$empr['latitude'].'
                    },';
            }
          ?>  
        ];
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      div.sticky {
        position: -webkit-sticky;
        position: sticky;
        top: 0;
      }
      .hide{
        display:none;
      }
      .show{
        display:true;
      }
    </style>

</head>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&callback=initMap"async defer></script>
<?php   
 /* if ($_SESSION['grup_id'] == 4){
    include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
    include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
  }
  elseif ($_SESSION['grup_id'] == 1){    
      include_once(ROOT_PATH."menu_footer/menu_administrador.php");
  }
  else{    
      include_once(ROOT_PATH."menu_footer/menu_usuario.php");
      include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
  } */
?>
<!--script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&libraries=places"></script-->
<body>
<?php
        if ($_SESSION['grup_id'] == 4){
          include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
        }
        if ($_SESSION['grup_id'] == 3){    
          
           include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
        }

?>
  <div class="col-md-6 fixed-top" style="margin-left:40%; margin-top: 65px; ">
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
  <!--button id="filtrar_modal" class="btn btn-success sticky-top" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Filtro" title="Filtro" onclick="filtro()">Filtro</button-->
  <div id="map" style="margin-left:13.5%; width:86%;"></div>
   
  <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
</body>

<script>

      function initMap() {
      
        var centro = {lat: -23.4930258, lng: -46.6093386};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: centro
        });
        
        //Criação de marcadores no google maps
        for(var o in markers){
          var icone = '';
          //Criação de descrição do marcador 
          var contentString = '<div id="content">'+
              '<div id="siteNotice">'+
              '<img style="width:200px;" src="'+markers[o].imagem+'" style="width:100%"/>'+
              '</div>'+
              '<h1 id="firstHeading" class="firstHeading">'+ 
                markers[o].nome +
              '</h1>'+
              '<div id="bodyContent">'+
                '<p>'+
                  'Idade:'+markers[o].idade+'<br/> Porte: ' + markers[o].porte + '<br/>Genero: '+ markers[o].genero+'<br/>Categoria: '+markers[o].categoria +
                  '<br/>Restrição: '+ markers[o].restricao+'<br/>Castração: '+ markers[o].castracao+
                '</p>'+
                '<p>'+
                  markers[o].endereco +', '+ markers[o].numero + ' - ' + markers[o].bairro + ',' + markers[o].cidade + ' - ' + markers[o].cep+  
                '</p>'+
              '</div>'+
            '</div>';

          //Declaração para a criação de janela com descrição no marcador
          var infowindow = new google.maps.InfoWindow({
            content: contentString
          });
          
          if(markers[o].categoria == 'gato'){
            icone = '../static/icones/cat.png'
          }else if(markers[o].categoria == 'cachorro'){
            icone  = '../static/icones/animais.png'
          }else{
            icone  = '../static/icones/animais_pata.png'
          }

          //Criação de marcador
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng( markers[o].latitude, markers[o].longitude),
              map: map,
              title: markers[o].nome,
              icon: icone
            });
        
          /*
          //Definição de ação quando usuário clicar no marcador
            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
          }
          */
          setMessage(marker,contentString);
        }
      }

      function setMessage(marker, contentString) {
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });

        marker.addListener('click', function() {
          infowindow.open(marker.get('map'), marker);
        });
      }
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
 



</script>
<footer>

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>
<script src="<?php echo $server_static;?>static/jquery.js"></script>
<script src="<?php echo $server_static;?>static/bootstrap/js/bootstrap.js"></script>
</html>
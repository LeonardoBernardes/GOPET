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
    
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.'index.php');
    }
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

    $logado = $_SESSION['login'];
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    $castracao = '';
    $results = "";
    $arr_empreendimentos = array();

    $sql = "SELECT 
              empreendimentos_enderecos.emen_id AS id,
              empreendimentos.empr_id AS empr_id,
              empreendimentos.empr_nome AS nome,
              empreendimentos.empr_slogan AS slogan,
              empreendimentos_enderecos.emen_logradouro AS endereco,
              empreendimentos_enderecos.emen_numero AS numero,
              empreendimentos_enderecos.emen_estado AS estado,
              empreendimentos_enderecos.emen_cidade AS cidade,
              empreendimentos_enderecos.emen_bairro AS bairro,
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
                login.logi_status = 1";

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
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($result)){

      //validação de imagem no cadastro
      if(!empty($row->imagem)){
        $endereco_img = $row->imagem;
      }

        $arr_empreendimento[$row->id] = [
          "nome" => $row->nome,
          "slogan" => $row->slogan,
          "endereco" => $row->endereco,
          "numero" => $row->numero,
          "estado" => $row->estado,
          "cidade" => $row->cidade,
          "bairro" => $row->bairro,
          "cep" => $row->cep,
          "latitude" => floatVal($row->latitude),
          "longitude" => floatVal($row->longitude),
          "imagem" => str_replace('\\', '/',$server_static.'empreendimentos/'.$endereco_img)
        ];
      }
      
    ?> 
<!DOCTYPE html>
<html>

<head>
<?php
        if ($_SESSION['grup_id'] == 4){
        include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
        //include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
        }
        if ($_SESSION['grup_id'] == 1){    
            include_once(ROOT_PATH."menu_footer/menu_administrador.php");
        }
        if ($_SESSION['grup_id'] == 3){    
            include_once(ROOT_PATH."menu_footer/menu_usuario.php");
         //   include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
        }

?>
    <!-- Criador de objeto marker no google maps -->
    <script>
      var markers =
        [
          //cria um array em js de objetos de empreendimentos
          <?php
            foreach($arr_empreendimento as $empr){
              echo '{nome:"'.$empr['nome'].'",slogan:"'.$empr['slogan'].'", endereco:"'.$empr['endereco'].
                '", numero:"'.$empr['numero'].'", estado:"'.$empr['estado'].'", cidade:"'.$empr['cidade'].
                '", bairro:"'.$empr['bairro'].'", cep:"'.$empr['cep'].'", latitude:'.$empr['latitude'].
                ', longitude:'.$empr['longitude'].', imagem:"'.$empr['imagem'].'"},';
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
    </style>

</head>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&callback=initMap"async defer></script>

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
   
    <div id="map" style="margin-left:13.5%; width:86%;"></div>
   
    

    <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
</body>
<script>
      function initMap() {
      
        var centro = {lat: -23.533773, lng: -46.625290};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: centro
        });

        //Criação de marcadores no google maps
        for(var o in markers){

          //Criação de descrição do marcador 
          var contentString = 
          '<div id="content">'+
              '<div id="siteNotice">'+
              '<img style="width:200px;" src="'+markers[o].imagem+'" style="width:100%"/>'+
              '</div>'+
              '<h1 id="firstHeading" class="firstHeading">'+ 
                markers[o].nome +
              '</h1>'+
              '<div id="bodyContent">'+
                '<p>'+
                  markers[o].endereco +', '+ markers[o].numero + ' - ' + markers[o].bairro + ',' + markers[o].cidade + ' - ' + markers[o].cep+  
                '</p>'+
                '<p>'+
                  markers[o].slogan +
                '</p>'+
              '</div>'+
            '</div>';

        //Declaração para a criação de janela com descrição no marcador
        var infowindow = new google.maps.InfoWindow({
          content: contentString,
          position: new google.maps.LatLng( markers[o].latitude, markers[o].longitude)
        });
        
        //Criação de marcador
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng( markers[o].latitude, markers[o].longitude),
            map: map,
            title: markers[o].nome,
            icon:'../static/icones/empresas.png'
          });
        
        /*
        //Definição de ação quando usuário clicar no marcador
          marker.addListener('click', function() {
            infowindow.setContent(contentString);
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

</script>
<footer>

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>
<!-- Optional JavaScript -->    
<script src="<?php echo $server_static?>static/jquery.js"></script> 
<script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script> 
</html>
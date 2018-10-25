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
     
    $logado = $_SESSION['login'];
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    $castracao = '';
    $results = "";
    $arr_animais = array();

    $sql = "SELECT
                anen_id as id,
                anen_logradouro as logradouro,
                anen_numero as numero,
                anen_complemento as complemento,
                anen_estado as estado,
                anen_cidade as cidade,
                anen_bairro as bairro,
                anen_cep as cep,
                anen_longitude as latitude,
                anen_latitude as longitude
            FROM 
                animais_endereco";

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($result)){

        $arr_animais[$row->id] = [
          "id" => $row->id,
          "logradouro" => $row->logradouro,
          "numero" => $row->numero,
          "complemento" => $row->complemento,
          "anen_estado" => $row->estado,
          "anen_cidade" => $row->cidade,
          "anen_bairro" => $row->bairro,
          "anen_cep" => $row->cep,
          "latitude" => floatVal($row->latitude),
          "longitude" => floatVal($row->longitude)
        ];
      }
    
    include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
    include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
    ?>
    
<!DOCTYPE html>
<html>

<head>
    <!-- Criador de objeto marker no google maps -->
    <script>
        alert()
      var markers =
        [
          //cria um array em js de objetos de empreendimentos
          <?php
            $inc=0;
            foreach($arr_animais as $empr){
              echo '{id:"'.$empr['id'].'", latitude:'.$empr['latitude'].',longitude:'.$empr['longitude'].'},';
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
    <div id="map"></div>
   
     

    <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
</body>
<script>
      function initMap() {
      
        var centro = {lat: -11.235, lng: -51.9253};

        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 5,
          center: centro
        });

        //Criação de marcadores no google maps
        for(var o in markers){

          //Criação de descrição do marcador 
          var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">Uluru</h1>'+
            '<div id="bodyContent">'+
            '<p><b>Uluru</b>, also referred to as <b>Ayers Rock</b>, is a large ' +
            'sandstone rock formation in the southern part of the '+
            'Northern Territory, central Australia. It lies 335&#160;km (208&#160;mi) '+
            'south west of the nearest large town, Alice Springs; 450&#160;km '+
            '(280&#160;mi) by road. Kata Tjuta and Uluru are the two major '+
            'features of the Uluru - Kata Tjuta National Park. Uluru is '+
            'sacred to the Pitjantjatjara and Yankunytjatjara, the '+
            'Aboriginal people of the area. It has many springs, waterholes, '+
            'rock caves and ancient paintings. Uluru is listed as a World '+
            'Heritage Site.</p>'+
            '<p>Attribution: Uluru, <a href="https://en.wikipedia.org/w/index.php?title=Uluru&oldid=297882194">'+
            'https://en.wikipedia.org/w/index.php?title=Uluru</a> '+
            '(last visited June 22, 2009).</p>'+
            '</div>'+
            '</div>';

        //Declaração para a criação de janela com descrição no marcador
        var infowindow = new google.maps.InfoWindow({
          content: contentString
        });
        
        //Criação de marcador
          var marker = new google.maps.Marker({
            position: new google.maps.LatLng( markers[o].latitude, markers[o].longitude),
            map: map,
            title: markers[o].nome
          });
        
        //Definição de ação quando usuário clicar no marcador
          marker.addListener('click', function() {
            infowindow.open(map, marker);
          });
        }
        
      }
</script>
<footer>

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>

</html>
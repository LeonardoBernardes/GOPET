
<?php 
/*
 * @Author: Rafael Yuiti Haga
 * @Date: 2018-09-12 19:55:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-18 19:37:06
 */
    include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
    session_start();
    
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            unset($_SESSION['grup_id']);
            header('location:index.php');
        }
     
    $logado = $_SESSION['login'];
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    $castracao = '';
    $results = "";
    $arr_animais = array();

    $sql = "SELECT
                empr_id,
                empr_nome as nome,
                empr_slogan as slogan,
                empr_longitude as latitude,
                empr_latitude as longitude
            FROM 
                empreendimentos";

    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_object($result)){

      $arr_empreendimento[$row->empr_id] = [
        "nome" => $row->nome,
        "slogan" => $row->slogan,
        "latitude" => floatVal($row->latitude),
        "longitude" => floatVal($row->longitude)
      ];
    }


    include_once("../menu_footer/menu_empreendimento.php"); 
    ?>
    
<!DOCTYPE html>
<html>

<head>
<script>
        var markers =
        [
          //cria um array em js de objetos de empreendimentos
          <?php
          $inc=0;
            foreach($arr_empreendimento as $empr){
              echo '{nome:"'.$empr['nome'].'", latitude:'.$empr['latitude'].',longitude:'.$empr['longitude'].'},';
            }
          ?>  
        ];
        </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/estilo.css">
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        /* left: 540px; */
        height: 100%;
        width: 100%px;
        /*max-width:800px;*/
      }
    </style>
</head>

<body>
    <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
    <div class="container col-md-12">

    <div id="map"></div>
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
    <?php
    print_r($arr_empreendimento);
    ?>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&callback=initMap">
    </script>



        
    </div>

</body>

<footer>

    <?php 
    include_once("../menu_footer/footer.php");     
    ?>

</footer>

</html>
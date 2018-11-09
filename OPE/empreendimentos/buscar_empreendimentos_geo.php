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
    $arr_empreendimentos = array();

    $sql = "SELECT
              empreendimentos_enderecos.emen_id as id,
              empreendimentos.empr_nome as nome,
              empreendimentos.empr_slogan as slogan,
              empreendimentos_enderecos.emen_logradouro as endereco,
              empreendimentos_enderecos.emen_numero as numero,
              empreendimentos_enderecos.emen_estado as estado,
              empreendimentos_enderecos.emen_cidade as cidade,
              empreendimentos_enderecos.emen_bairro as bairro,
              empreendimentos_enderecos.emen_cep as cep,
              empreendimentos_enderecos.emen_longitude as latitude,
              empreendimentos_enderecos.emen_latitude as longitude,
              empreendimentos_imagens.emim_endereco as imagem
            FROM 
              empreendimentos_enderecos
            INNER JOIN
              empreendimentos
            ON
              (empreendimentos_enderecos.empr_id = empreendimentos.empr_id)
            INNER JOIN
              empreendimentos_imagens
            ON
              (empreendimentos_enderecos.empr_id = empreendimentos_imagens.empr_id)";
//echo $sql;
//return;
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
    include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
    include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
    ?>
    
<!DOCTYPE html>
<html>

<head>
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
            title: markers[o].nome
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

</html>
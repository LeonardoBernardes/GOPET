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
    $castracao = '';
    $results = "";
    $arr_animais = array();

    $sql = "SELECT
              animais.anim_id as id,
              animais.anim_nome as nome,
              animais.anim_idade as idade,
              animais.anim_porte as porte,
              animais.anim_genero as genero,
              animais.anim_categoria as categoria,
              animais.anim_restricao_doacao as restricao,
              animais.anim_castracao as castracao,
              animais_fotos.anfo_endereco as imagem,
              animais_endereco.anen_logradouro as endereco,
              animais_endereco.anen_numero as numero,
              animais_endereco.anen_logradouro as complemento,
              animais_endereco.anen_pais as pais,
              animais_endereco.anen_estado as estado,
              animais_endereco.anen_cidade as cidade,
              animais_endereco.anen_bairro as bairro,
              animais_endereco.anen_cep as cep,
              animais_endereco.anen_longitude as latitude,
              animais_endereco.anen_latitude as longitude
            FROM 
              animais
            INNER JOIN
              animais_fotos
            ON 
              (animais.anim_id = animais_fotos.anim_id)
            INNER JOIN
              animais_endereco
            ON 
              (animais.anim_id = animais_endereco.anim_id)";

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
        $castracao = "sim";
      }
      else{
        if($row->anim_castracao = 1)
        {
          $castracao = "não";
        }
        else{
          $castracao = "não informado";
        }
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

/*
      foreach($arr_animais as $empr){
        $json_a .= '{nome:"'.$empr['nome'].'", idade:'.$empr['idade'].', porte:"'.$empr['porte'].'", genero:"'.$empr['genero'].'", categoria:"'.$empr['categoria'].
          '", restricao:"'.$empr['restricao'].'", castracao:"'.$empr['castracao'].'", imagem:"'.$empr['imagem'].'", endereco:"'.$empr['endereco'].
          '", numero:"'.$empr['numero'].'", complemento:"'.$empr['complemento'].'", estado:"'.$empr['estado'].'", cidade:"'.$empr['cidade'].
          '", bairro:"'.$empr['bairro'].'", cep:"'.$empr['cep'].'", latitude:'.$empr['latitude'].',longitude:'.$empr['longitude'].'},';
      }
      $json_a = substr($json_a,0,-1);
*/

      if ($_SESSION['grup_id'] == 4){
        include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
        include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
        }
        if ($_SESSION['grup_id'] == 1){    
            include_once(ROOT_PATH."menu_footer/menu_administrador.php");
        }
        if ($_SESSION['grup_id'] == 3){    
            include_once(ROOT_PATH."menu_footer/menu_usuario.php");
            include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
        }
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
            /*foreach($arr_animais as $empr){
                        echo $json_a;
            }*/

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
                      latitude:'.$empr['latitude'].',
                      longitude:'.$empr['longitude'].'
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
    </style>

</head>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC1nkX5KVBXgDHas0sYoCXqws8MzKCWBcQ&callback=initMap"async defer></script>
<?php  if ($_SESSION['grup_id'] == 4){
        include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
        include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
        }
        if ($_SESSION['grup_id'] == 1){    
            include_once(ROOT_PATH."menu_footer/menu_administrador.php");
        }
        if ($_SESSION['grup_id'] == 3){    
            include_once(ROOT_PATH."menu_footer/menu_usuario.php");
            include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
        } ?>
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
        
          //Criação de marcador
            var marker = new google.maps.Marker({
              position: new google.maps.LatLng( markers[o].latitude, markers[o].longitude),
              map: map,
              title: markers[o].nome
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
</script>
<footer>

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>
<script src="<?php echo $server_static;?>static/jquery.js"></script>
<script src="<?php echo $server_static;?>static/bootstrap/js/bootstrap.js"></script>
</html>
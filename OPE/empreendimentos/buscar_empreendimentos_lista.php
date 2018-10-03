<?php 
/*
 * @Author: Rafael Yuiti Haga
 * @Date: 2018-09-12 19:55:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-18 20:22:43
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
     
    $logado = $_SESSION['login'];
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    $castracao = '';
    $results = "";
    $arr_empreendimentos = array();

    $sql = "SELECT 
              empr.empr_id,
              empr.empr_nome as nome,
              emen.emen_logradouro as logradouro, 
              emen.emen_numero as numero, 
              emen.emen_complemento as complemento,
              emen.emen_estado as estado, 
              emen.emen_cidade as cidade,
              emen.emen_bairro as bairro, 
              emen.emen_cep as cep, 
              emen.emen_pais as pais
            FROM 
              empreendimentos empr 
              LEFT JOIN empreendimentos_enderecos emen ON emen.empr_id = empr.empr_id";
//echo $sql;
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
      $results .='<div class="col-md-12 card">
                    <div class="col-md-6">
                      <span colspan="2">Nome: '.$row->nome.'</span><br>
                      <span colspan="1">Logradouro: '.$row->logradouro.'</span><br>
                      <span colspan="1">Número: '.$row->numero.'</span><br>
                      <span colspan="1">Complemento: '.$row->complemento.'</span><br>
                      <span colspan="1">CEP: '.$row->cep.'</span>

                    </div>
                    <div class="col-md-6">
                      <span colspan="1">País: '.$row->pais.'</span><br>
                      <span colspan="1">Estado: '.$row->estado.'</span><br>
                      <span colspan="1">Cidade: '.$row->cidade.'</span><br>
                      <span colspan="1">Bairro: '.$row->bairro.'</span>
                      <button class="btn btn-success" style="margin-left:60px;">Animais</button>
                      <button class="btn btn-success" style="margin-left:15px;">Eventos</button>
                      <button class="btn btn-success" style="margin-left:15px;">Produtos</button>
                      <button class="btn btn-success" style="margin-left:15px;">Serviços</button>
                    </div>
                    
                    
                    
                  </div>';

    }
    json_encode($arr_empreendimentos_JSON);
    


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
<?php /*
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
    }*/
    echo $results 
  ?>
     
     <?php
    if ($_SESSION['grup_id'] == 4){
        ?>
        <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
    <?php
    }
    if ($_SESSION['grup_id'] == 3){    
    ?>
       <a class="btn btn-dark" href="..\usuarios\home_usuarios.php"> Voltar</a>
    <?php
    }
    ?>
</body>

<footer>

    <?php 
    include_once("../menu_footer/footer.php");     
    ?>

</footer>

</html>
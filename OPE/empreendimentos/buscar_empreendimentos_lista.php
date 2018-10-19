<?php 
/*
 * @Author: Rafael Yuiti Haga
 * @Date: 2018-09-12 19:55:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-10-04 20:20:16
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
              empr.empr_id as empr_id,
              empr.empr_nome as nome,
              emen.emen_logradouro as logradouro, 
              emen.emen_numero as numero, 
              emen.emen_complemento as complemento,
              emen.emen_estado as estado, 
              emen.emen_cidade as cidade,
              emen.emen_bairro as bairro, 
              emen.emen_cep as cep, 
              emen.emen_pais as pais,
              img.emim_endereco as imagem
            FROM 
              empreendimentos empr 
              LEFT JOIN empreendimentos_enderecos emen ON emen.empr_id = empr.empr_id
              LEFT JOIN empreendimentos_imagens img ON img.empr_id = empr.empr_id";
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
      $endereco_img = (!empty($row->imagem)) ? $row->imagem : '';

      if(!empty($endereco_img)){
        //Criar Funcao para trazer local host como variavel
        $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/'.$endereco_img);
      }
      $results .='
   <div class="main">
        <div class="container login-empreendimento">
                <fieldset id="fie">
                      <img style="width:150px;" src="'.$endereco_img.'" style="width:100% class="img-thumbnail""/>
                      <span class="input-group-text" for="inputGroupSelect01">Nome: '.$row->nome.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">Logradouro: '.$row->logradouro.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">Número: '.$row->numero.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">Complemento: '.$row->complemento.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">CEP: '.$row->cep.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">País: '.$row->pais.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">Estado: '.$row->estado.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">Cidade: '.$row->cidade.'</span>
                      <span class="input-group-text" for="inputGroupSelect01">Bairro: '.$row->bairro.'</span><hr>
                      <button id="animais/'.$row->empr_id.'"  class="btn btn-success sticky-top" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Animais" title="Animais" value="'.$row->empr_id.'" onclick="getId(this)">Animais</button>
                      <button id="eventos/'.$row->empr_id.'"   class="btn btn-success sticky-top" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Eventos" title="Eventos" value="'.$row->empr_id.'" onclick="getId(this)">Eventos</button>
                      <button id="produtos/'.$row->empr_id.'"   class="btn btn-success sticky-top" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Produtos" title="Produtos" value="'.$row->empr_id.'" onclick="getId(this)">Produtos</button>
                      <button id="servicos/'.$row->empr_id.'"   class="btn btn-success sticky-top" style="margin-left:15px;" data-toggle="modal" data-target="#myModal" data-whatever="Serviços" title="Serviços" value="'.$row->empr_id.'" onclick="getId(this)">Serviços</button>
                     </fieldset>
            </div>
</div>
';

    }
    json_encode($arr_empreendimentos_JSON);
   /* 

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
 */
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
</script>
<footer>

    <?php 
    include_once("../menu_footer/footer.php");     
    ?>

</footer>

</html>
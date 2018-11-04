<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-09 01:19:46 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-18 16:28:54
 */
include_once 'config/server.php';
//var_dump($_SESSION);
//return;

?>
<!doctype html>
<html lang="pt-br">

<?php
    
include_once ROOT_PATH."menu_footer/menu_principal.php" 
    
?>
<style>    
#index{
margin-top:8%;
}
</style>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
    <title>Gopet</title>
</head>

<body >
  

    
     <!-- MEIO -->
 <main role="main">

      

      <!-- Marketing messaging and featurettes
      ================================================== -->
      <!-- Wrap the rest of the page in another container to center all the content. -->

      <div class="container marketing">

        <!-- Three columns of text below the carousel -->
        <div id="index" class="row">
          <div class="col-lg-4">
            <img class="rounded-circle" src="../OPE/static/imagens/android.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Aplicativo</h2><span class="text-muted">
              <p>Nossa ferramenta também está disponivel na versão android.</p></span>
            <p><a class="btn btn-outline-dark" href="#" role="button">Download &raquo;</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="../OPE/static/imagens/produtos.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Produto</h2><span class="text-muted">
              <p>
                ● Perfume.
            <br>
                ● Shampoo.
            <br>
                ● Sabonete.
              </p>
            </span>
              <p><a class="btn btn-outline-dark" href="#" role="button">Mais detalhes</a></p>
          </div><!-- /.col-lg-4 -->
          <div class="col-lg-4">
            <img class="rounded-circle" src="../OPE/static/imagens/parceria.jpg" alt="Generic placeholder image" width="140" height="140">
            <h2>Parceria</h2><span class="text-muted">
            <p>
                ● PetShop.
            <br>
                ● PetDog.
            <br>
                ● PetHit.
              </p></span>
            <p><a class="btn btn-outline-dark" href="#" role="button">Mais detalhes</a></p>
          </div><!-- /.col-lg-4 -->
        </div><!-- /.row -->


        <!-- START THE FEATURETTES -->

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Introdução <span class="text-muted">da nossa ferramenta.</span></h2>
              <p class="lead">O Sistema <b>GOPET</b> é uma ferramenta web para facilitar adoção de animais,
                seja ele pertencente a uma instituição de doação ou de alguma família que tem
                a intensão de doar. Além disso, os usuários cadastrados poderão fornecer a
                localização de animais abandonados ou resgatar os mesmos. Paralelamente
                clínicas especializadas no tratamento de animais e outros empreendimentos,
                tais como Pet Shop, poderão publicar os seus serviços e futuramente produtos
                oferecidos. Assim como aumentar a divulgação de eventos relacionados aos
                pets.</p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="../OPE/static/imagens/introducao.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7 order-md-2">
            <h2 class="featurette-heading">Problemas <span class="text-muted">encontrados</span></h2>
            <p class="lead">De acordo com estudos da OMS (Organização Mundial da Saúde) em 2014
                relata que há cerca de 30 milhões de animais abandonados no Brasil (MAPAA,
                2015). Porém, esse número é reflexo da lotação de animais em ONGs
                (Organização não Governamental) que realizam o resgate desses animais,
                falta de informação sobre os animais perdidos, baixa divulgação de ONGs e
                empreendimentos que tem o objetivo de proporcionar saúde de qualidade para
                os animais e pouca conscientização da população relacionada aos maus-tratos
                e abandono.</p>
          </div>
          <div class="col-md-5 order-md-1">
            <img class="featurette-image img-fluid mx-auto" src="../OPE/static/imagens/problemas.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <hr class="featurette-divider">

        <div class="row featurette">
          <div class="col-md-7">
            <h2 class="featurette-heading">Objetivo <span class="text-muted">para criação do software.</span></h2>
            <p class="lead">Criar um sistema web para auxiliar na redução da quantidade de animais
                nas ruas e proporcionar um novo lar a estes animais. Os objetivos
                específicos do trabalho são:
               <br>
                ● Auxiliar a adoção, doação e resgate de animais.
                <br>
                
                ● Facilitar a localização de animais abandonados e empreendimentos
                que cuidam da saúde e bem-estar animal.
               <br>
                ● Aumentar a divulgação de eventos relacionados aos pets.
                <br>
                ● Maior controle no gerenciamento de animais resgatados e adotados.
                <br>
                ● Acessível por múltiplas plataformas.
                <br>
                ● Incentivar a adoção de animais.
              </p>
          </div>
          <div class="col-md-5">
            <img class="featurette-image img-fluid mx-auto" src="../OPE/static/imagens/objetivos.jpg" data-src="holder.js/500x500/auto" alt="Generic placeholder image">
          </div>
        </div>

        <!-- /END THE FEATURETTES -->

      </div><!-- /.container -->


      <!-- FOOTER -->
     
    </main>
<?php
    
include_once ROOT_PATH."menu_footer/footer.php" 
    
?>


<!-- Optional JavaScript -->
<script src="static/jquery.js"></script>
<script src="static/bootstrap/js/bootstrap.js"></script>
</body>
</html>



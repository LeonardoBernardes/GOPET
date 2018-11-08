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
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="assets/css/docs.css" rel="stylesheet">
  <link href="assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="assets/css/flexslider.css" rel="stylesheet">
  <link href="assets/css/sequence.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/color/default.css" rel="stylesheet">
    <title>Gopet</title>
</head>

<body >
  

    
     <!-- MEIO -->
 <main role="main">

      


  <section id="intro">
    <div class="jumbotron masthead">
      <div class="container">
        <!-- slider navigation -->
        <div class="sequence-nav">
          <div class="prev">
            <span></span>
          </div>
          <div class="next">
            <span></span>
          </div>
        </div>
        <!-- end slider navigation -->
        <div class="row">
          <div class="span12">
            <div id="slider_holder">
              <div id="sequence">
                <ul>
                  <!-- Layer 1 -->
                  <li>
                    <div class="info animate-in">
                      <h2>GoPet</h2>
                      <br>
                      <p>
                         Sistema que Conecta pessoas e Animais
                      </p>
                    </div>
                    <img class="slider_img animate-in" src="static/imagens/dog-188273_1920.jpg" alt="">
                  </li>
                  <!-- Layer 2 -->
                  <li>
                    <div class="info">
                      <h2>Negocio</h2>
                      <br>
                      <p>
                       Anuncie Já.
                      </p>
                    </div>
                    <img class="slider_img" src="static/imagens/cao-aventura.jpg" alt="">
                  </li>
                  <!-- Layer 3 -->
                  <li>
                    <div class="info">
                      <h2>GoPet</h2>
                      <br>
                      <p>
                        Sistema que Conecta pessoas e Animais
                      </p>
                    </div>
                    <img class="slider_img" src="static/imagens/adorable-car.jpg" alt="">
                  </li>
                </ul>
              </div>
            </div>
            <!-- Sequence Slider::END-->
          </div>
        </div>
      </div>
    </div>
  </section>
  <section id="maincontent">
    <div class="container">
      <div class="row">
        <div class="span3 features">
          <i class="icon-circled icon-32 icon-suitcase left active"></i>
          <h4>Empresa</h4>
          <div class="dotted_line">
          </div>
          <p class="left">
            Nossa parceria pode ser seu melhor negocio, anunciamos seus produtos, seus serviços por um preço muito acessivel.
          </p>
        </div>
        <div class="span3 features">
          <i class="icon-circled icon-32 icon-plane left"></i>
          <h4>Sua viagem, Nossa ajuda</h4>
          <div class="dotted_line">
          </div>
          <p class="left">
            Utilize seu dia como um apoio para sociedade, facil e simples com apenas um clique e uma foto você ja pode tirar um animal da rua.
          </p>
        </div>
        <div class="span3 features">
          <i class="icon-circled icon-32 icon-wrench left"></i>
          <h4>Ferramenta</h4>
          <div class="dotted_line">
          </div>
          <p class="left">
            Sistema que Conecta pessoas e animais.
          </p>
        </div>
      </div>
      <div class="row">
        <div class="">
          <div class="tagline centered">
            <div class="row">
              <div class="span12">
                <div class="tagline_text">
                  <h2>Aplicativo</h2>
                </div>
                <div class="btn-toolbar cta">
                  <a class="btn btn-large btn-color" href="#">
							<i class="icon-plane icon-white"></i> Download </a>
                </div>
              </div>
            </div>
          </div>
          <!-- end tagline -->
        </div>
      </div>
      

  <!-- JavaScript Library Files -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.easing.js"></script>
  <script src="assets/js/google-code-prettify/prettify.js"></script>
  <script src="assets/js/modernizr.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/jquery.elastislide.js"></script>
  <script src="assets/js/sequence/sequence.jquery-min.js"></script>
  <script src="assets/js/sequence/setting.js"></script>
  <script src="assets/js/jquery.prettyPhoto.js"></script>
  <script src="assets/js/application.js"></script>
  <script src="assets/js/jquery.flexslider.js"></script>
  <script src="assets/js/hover/jquery-hover-effect.js"></script>
  <script src="assets/js/hover/setting.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="assets/js/custom.js"></script>


    </main>
<?php
    
include_once ROOT_PATH."menu_footer/footer.php" 
    
?>


</body>
</html>




<!DOCTYPE html>
 <!-- Optional JavaScript -->
 <script src="<?php echo $server_static;?>static/jquery.js"></script>
    <script src="<?php echo $server_static;?>static/bootstrap/js/bootstrap.js"></script>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
    font-family: "Lato", sans-serif;
}

.sidenav {
    width: 180px;
    height:100%;
    position: fixed;
    z-index: 1;
    top: 10px;
    background: #eee;
    overflow-x: hidden;
    padding: 0px;
}

.sidenav a {
   
    text-decoration: none;
   /* color: #2196F3;*/
    color:rgb(0, 0, 0) !important;
    display: block;
}

.sidenav a:hover {
    color: white;
}

.main {
    margin-left:170px; /* Same width as the sidebar + left position in px */
    font-size: 20px; /* Increased text to enable scrolling */
    padding: 10px;
}
/*
.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}*/
.nav-pills >li{
    margin-left:5px;
    margin-right:5px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
.nav-pills >li>a{
    border-radius:10px;
   
}
.nav-pills>li.active>a,.nav-pills>li.active>a:focus,.nav-pills>li.active>a:hover
    {
        color:#fff;
        background-color:#8bff8e;
        padding: 15px;
     
    }
#menu_lateral{
    background: #4fdc6f;
    box-shadow: 3px 0px white;
    color:rgb(0, 0, 0) !important;
    line-height: 4.5;
}
ul{
    width:100%;
}
</style>

</head>

<body>
<?php 

$menu = '';

if ($_SESSION['grup_id'] == 4){

    $menu .='    <nav aria-label="Page navigation example" style="margin-top:10%;">
                    <li class="nav-item item-menu-empreendimento">
                    <a class="nav-link" href="'. $server_static.'empreendimentos/cadastro_empreendimentos.php"><img src="'. $server_static.'static/icones/dados.png" style="width:20px;"/> Meus Dados</a>
                </li>
            ';
    
}              
if($_SESSION['logi_status'] == 1){ 

    $menu .='   
    
                <li class="nav-item item-menu-empreendimento">
                    <a class="nav-link" href="'. $server_static.'animais/consulta_animais.php"><img src="'. $server_static.'static/icones/animais.png" style="width:20px;"/> Meus Animais </a>
                </li>
                <li class="nav-item item-menu-empreendimento">
                    <a class="nav-link" href="'. $server_static.'empreendimentos/produtos/consultar_produtos.php"><img src="'. $server_static.'static/icones/produtos.png" style="width:20px;"/> Meus Produtos </a>
                </li>
                <li class="nav-item item-menu-empreendimento">
                    <a class="nav-link" href="'. $server_static.'empreendimentos/servicos/consultar_servicos.php"><img src="'. $server_static.'static/icones/servicos.png" style="width:20px;"/> Meus Serviços </a>
                </li>
                <li class="nav-item item-menu-empreendimento">
                <a class="nav-link" href="'. $server_static.'empreendimentos/eventos/consultar_eventos.php"><img src="'. $server_static.'static/icones/eventos.png" style="width:20px;"/> Meus Eventos</a>
                </li>
                <!--li class="nav-item item-menu-empreendimento">
                    <a class="nav-link" href="#">Minhas Doações</a>
                </li>
                <li class="nav-item item-menu-empreendimento">
                    <a class="nav-link" href="#">Favoritos</a>
                </li-->
            </nav>
    ';
}


            
?>


<nav id="menu_lateral" class="position-fixed sidenav navbar navbar-light nav_bar_empreendimento" >

<ul class="navbar-nav nav-pills" style="margin-left:0px;">

    <?php echo $menu ?>
</ul>

</nav>

   

</body>

</html> 
<script>/*
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}*/
</script>
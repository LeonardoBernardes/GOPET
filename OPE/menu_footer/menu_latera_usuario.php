<?php

include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';

if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.'index.php');
    }
    //var_dump($_SESSION);
    $logi_id = $_SESSION['logi_id'];
?>
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
    padding: 8px 0;
}

.sidenav a {
    padding: 10px 8px 30px 16px;
    text-decoration: none;
    color: #2196F3;
    display: block;
}

.sidenav a:hover {
    color: #064579;
}


.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .content {
  padding-top: 60px;
}
    
.main {
    margin-left: 170px; /* Same width as the sidebar + left position in px */
/*  font-size: 28px; /* Increased text to enable scrolling */
    padding: 10px;
}

@media screen and (max-height: 450px) {
    .sidenav {padding-top: 15px;}
    .sidenav a {font-size: 18px;}
}
</style>

</head>

<body>
<?php 
$menu = '';
//var_dump($_SESSION);
if ($_SESSION['grup_id'] == 3){

    $menu .='   <li class="nav-item item-menu-usuario">
                    <a class="nav-link" href="'. $server_static.'usuarios/cadastro_usuarios.php"><img src="'. $server_static.'static/icones/dados.png" style="width:20px;"/> Meus Dados </a>
                </li>

            ';
    
}              
    if($_SESSION['logi_status'] == 1){ 
        /*
        $sql = "SELECT
                    usua_id
                FROM
                    login_x_usuarios
                WHERE
                    logi_id  = $logi_id   
            ";

        $result = mysqli_query($conn, $sql);
        $row2 = mysqli_fetch_object($result);

        if(!empty($row2)){
*/
            $menu .='   <li class="nav-item item-menu-usuario">
                            <a class="nav-link" href="'. $server_static.'animais/consulta_animais.php"><img src="'. $server_static.'static/icones/animais.png" style="width:20px;"/> Meus Animais </a>
                        </li>
                        <li class="nav-item item-menu-usuario">
                        <a class="nav-link" href="'. $server_static.'usuarios/eventos/consultar_eventos.php"><img src="'. $server_static.'static/icones/eventos.png" style="width:20px;"/> Meus Eventos</a>
                        </li>
                        <li class="nav-item item-menu-usuario">
                        <a class="nav-link" href="'. $server_static.'usuarios/favoritos.php"><img src="'. $server_static.'static/icones/favoritos.png" style="width:20px;"/> Favoritos</a>
                        </li>
                        <!--li class="nav-item item-menu-usuario">
                            <a class="nav-link" href="'. $server_static.'usuarios/favoritos_animais.php"><img src="'. $server_static.'static/icones/eventos.png" style="width:20px;"/> Animais Favoritos</a>
                        </li-->
                        <!--li class="nav-item item-menu-usuario">
                        <a class="nav-link" href="'. $server_static.'usuarios/favoritos_empreendimentos.php"><img src="'. $server_static.'static/icones/eventos.png" style="width:20px;"/> Empreendimentos Favoritos</a>
                        </li-->
                       
                      
            ';

      //  }
    }


            
?>



<nav class="position-fixed sidenav navbar navbar-light bg-light nav_bar_usuario">
<ul class="navbar-nav mr-auto" style="margin-left:10px;">

    <?php echo $menu ?>
</ul>
</nav>

   

</body>

</html> 
<script>
window.onscroll = function() {myFunction()};

var navbar = document.getElementById("navbar");
var sticky = navbar.offsetTop;

function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}
</script>
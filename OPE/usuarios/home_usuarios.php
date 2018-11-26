<?php
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 20:59:32 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-24 21:15:14
 */

//var_dump($_SESSION);

   
 
?>
               <!-- Optional JavaScript -->
    <script src="<?php echo $server_static?>static/jquery.js"></script>
    <script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script>
    

<html>
<head>

    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="<?php echo $server_static;?>static/imagens/icon_preto.png">
    <title>GOPET</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
        


</head>
    <body>
    <?php 
        include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php"); 
        include_once(ROOT_PATH."menu_footer/menu_usuario.php"); 
        
    ?>
       <div class="main">
        <div class="one_page home">
            <h1><img class="logo_index" src="static/imagens/icon_preto.png" alt="" /></h1>
            <p class="alert alert-success">Seja Bem-vindo ao GOPET</p>
        </div>
        </div>
        
    </body> 
    
<?php 
    include_once(ROOT_PATH."menu_footer/footer.php"); 
?>   
</html>

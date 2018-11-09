<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-11-08 19:03:40 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-11-08 20:02:36
 */
include_once '../config/server.php';
include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION);
        header('location:'.$server_static.'index.php');
    }
include_once(ROOT_PATH."menu_footer/menu_usuario.php");
?>
<script src="<?php echo $server_static;?>static/jquery.js"></script>
<script src="<?php echo $server_static;?>static/bootstrap/js/bootstrap.js"></script>
<!DOCTYPE html>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
    <title>GOPET</title>
</head>

<body>
<?php
    
include_once ROOT_PATH."menu_footer/menu_latera_usuario.php" 
    
?>
<div class='main' style="margin-top:7%;">
    <button onclick="animaisFavoritos()" class="btn btn-dark"  style="width:100%; height:30%; text-align:center; font-size:24px;">Meus Animais Favoritos</button><br><br>
    <button onclick="empreendimentosFavoritos()" class="btn btn-success"  style="width:100%; height:30%; text-align:center; font-size:24px;">Meus Empreendimentos Favoritos</button>
</div>
</body>
<script>

function animaisFavoritos(){
    window.location.href="<?php echo $server_static?>usuarios/favoritos_animais.php";
}

function empreendimentosFavoritos(){
    window.location.href="<?php echo $server_static?>usuarios/favoritos_empreendimentos.php";
}
</script>
</html>
<footer>

<?php 
include_once(ROOT_PATH."menu_footer/footer.php");     
?>

</footer>
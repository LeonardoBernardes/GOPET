<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-11-08 19:55:13 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-11-08 20:02:10
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
</body>
<script>



</script>
</html>
<footer>

<?php 
include_once(ROOT_PATH."menu_footer/footer.php");     
?>

</footer>
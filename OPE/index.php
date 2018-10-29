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

<body >
  

    
     <!-- MEIO -->
<div class="one_page home">
    <h1><img class="logo_index" src="<?php echo $server_static;?>static/imagens/icon_preto.png" alt="" /></h1>
    <h2 class="frase_index">Sistema para conectar pessoas e animais para adoção</h2>
</div>

<?php
    
include_once ROOT_PATH."menu_footer/footer.php" 
    
?>


<!-- Optional JavaScript -->
<script src="static/jquery.js"></script>
<script src="static/bootstrap/js/bootstrap.js"></script>
</body>
</html>



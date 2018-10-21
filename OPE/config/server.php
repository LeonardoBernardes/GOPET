<?php
//todos essas variaveis retornam a ORIGEM DO PROJETO, RAIZ DO PROJETO

//usado para chamar arquivos php em INCLUDE
//C:/XAMPP/HTDOCS/FUNDAMENTA/
define('ROOT_PATH', $_SERVER['DOCUMENT_ROOT'].'/GOPET/OPE/');


//para chamar qualquer arquivo que nao seja outro arquivo php 
//ARQUIVOS CSS, JS, IMGs...
//HTTP://LOCALHOST/FUNDAMENTA/
$server_static = $_SERVER['REQUEST_SCHEME'].'://'.$_SERVER['SERVER_NAME'].'/GOPET/OPE/';


// versao beta para chamar arquivos PHP -->
//usado para chamar arquivos php
//C:/XAMPP/HTDOCS/FUNDAMENTA/
$server_dir = $_SERVER['DOCUMENT_ROOT'].'/GOPET/OPE/';



//EXEMPLO:
//INCLUDE include_once '../settings/server.php'; ---> esse caminho deve ser o caminho absoluto
//include_once ROOT_PATH.'users/base/nav.php';
//include_once ROOT_PATH.'settings/db_connection.php';
//<img src="<?php echo $server_static;? > <RESTANTE DO CAMINHO, A PARTIR DA ORIGEM> ">

?>
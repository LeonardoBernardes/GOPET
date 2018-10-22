
<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:54:57
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
 
$logado = $_SESSION['login'];

$sql="SELECT * FROM empreendimentos WHERE";
$result =  mysqli_query($conn, $sql);


include_once ROOT_PATH."menu_footer/menu_administrador.php" 

?>

<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
    <title>Gopet</title>
</head>

<body id="formulario_empreendimento">

<div class="main">
    <div class="container login-empreendimento"  >
    <form method="post" action="cadastrar_empreendimento.php" id="formlogin" name="formlogin" enctype="multipart/form-data" >
    <fieldset id="fie">
        <h2 class="btn btn-dark btn-sm btn-block"><legend>Cadastrar Grupos</legend></h2><br>
        <div class="form-row">
            <div class="col">
<form method="post" action="cadastrar_grupos.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <br/>
        <label>Nome do Grupo </label> 
        <input class="form-control form-control-sm" type="text" name="nome" id="nome"><br/>
        <input class="btn btn-success btn-sm btn-block" type="submit" value="Salvar Dados"><hr>
        
    </fieldset>
    <a class="btn btn-dark btn-sm btn-block" href="<?php echo $server_static;?>administradores/home_administradores.php"> Voltar</a>
</form>
            </div>
            </div>
            </fieldset>
            </form>
            </div>
            </div>
</body>
<?php 
include_once ROOT_PATH."menu_footer/footer.php"; 
?>
</html>
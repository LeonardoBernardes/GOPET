<?php
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-30 23:24:39
 */
include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.'index.php');
    }
 
$logado = $_SESSION['login'];

include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 


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
<?php
    
include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php" 
    
?>
    <div class="main">
        <div class="container login-empreendimento">
            
                <fieldset id="fie">
                    <h2 style="background:#4fdc6f; color:white;" class="btn btn-sm btn-block">
                        <legend>Cadastrar Evento</legend>
                    </h2>
                    <br>
                    <form method="post" action="cadastrar_eventos.php" id="formlogin" name="formlogin" enctype="multipart/form-data">
                        <fieldset id="fie">
                            <div class="card-group">
                                <div id="cadastro_animal_card" class="card">
                                    <label>Imagem : </label>
                                    <img src="" style="width:200px; heigth:50px;" alt='Foto de exibição' /><br />
                                    <input type="file" name="imagem" id="imagem"><br>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col">
                                    <label>Nome</label>
                                    <input class="form-control form-control-sm" type="text" name="nome" id="nome">
                                </div>
                                <div class="col">
                                    <label>Data de Realização</label>
                                    <input class="form-control form-control-sm" type="text" name="data_realizacao" id="data_realizacao">
                                </div>
                                <div class="col">
                                    <label>Status</label>
                                    <select class="form-control form-control-sm" name="status">
            <option value="1">Ativo</option>
            <option value="0" selected>Desativado</option>
        </select>
                                </div>
                            </div>
                            <label>Descrição</label>
                            <textarea class="form-control form-control-sm" type="text" name="descricao" id="descricao"></textarea>
                                <br>
                            <input style="background:#4fdc6f; color:white;" class="btn" type="submit" value="Cadastrar">

                        </fieldset>

                    </form>

                </fieldset>
         
        </div>
    </div>
</body>

<footer>

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>

</html>
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:55:58
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];
include_once "../menu_footer/menu_usuario.php" 

?>
<html>
<head>

    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="../static/imagens/icon_preto.png">
    <title>GoPet</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="../static/estilo.css">
        


</head>
<body class="one_page home">
    
        <div class="container login-empreendimento">
            <form method="post" action="cadastrar_animais.php" id="formlogin" name="formlogin" enctype="multipart/form-data">
                    <h2 class="btn btn-dark btn-sm btn-block">
                        <legend>Cadastrar Animal</legend>
                    </h2>
            <div class="form-row">            
                <div class="col">
                    <label>Nome </label> 
                    <input class="form-control form-control-sm" type="text" name="nome" id="nome"><br/>
                </div>
                <div class="col">
                    <label>Sobrenome </label> 
                    <input class="form-control form-control-sm" type="text" name="sobrenome" id="sobrenome"><br/>
                </div>
             </div>
                <div>
                    <label>CPF : </label> 
                    <input class="form-control form-control-sm" type="text" name="cpf" id="cpf"><br/>
                </div>
                <div>
                    <label>Data de Nascimento </label> 
                    <input class="form-control form-control-sm" type="text" name="data_nascimento" id="data_nascimento"><br/>
                </div>
                <input class="btn btn-success btn-sm btn-block" type="submit" value="Salvar Dados">
           </form>
    </div>    

</body>
<?php 
include_once "../menu_footer/footer.php" 
?>    
</html>
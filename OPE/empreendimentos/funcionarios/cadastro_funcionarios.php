<?php
include_once("../../menu_footer/menu_empreendimento.php"); 
?>

<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../static/estilo.css">
    
    
</head>

<body id="formulario_funcionario">
<?php
    
include_once "../../menu_footer/menu_latera_empreendimento.php" 
    
?>
<div>
<div class="main">
    <div class="container login-form"  >
        <h2 class="alert alert-warning" ><legend>Cadastrar Funcionário</legend></h2>
        <form method="post" action="cadastrar_funcionarios.php" id="formlogin" name="formlogin" >
            <fieldset id="fie">
                <br/>
                <label>Login </label> 
                <input class="input-group-text btn-lg btn-block" type="text" name="login_funcionario" id="login_funcionario"><br/>
                <label>E-mail </label>
                <input class="input-group-text btn-lg btn-block" type="text" name="email" id="email"><br/>
                <label>Senha </label>
                <input class="input-group-text btn-lg btn-block" type="password" name="senha" id="senha"><br/>
                <br>
                <input class="btn btn-success btn-lg btn-block" type="submit" value="Cadastrar">
                <hr>
                <a class="btn btn-dark btn-lg btn-block" href="..\home_empreendimento.php"> Voltar</a>
            </fieldset>
        </form>
    </div>
</div>
</div>


</body>

<footer>

    <?php 
    include_once("../../menu_footer/footer.php");     
    ?>

</footer>

</html>

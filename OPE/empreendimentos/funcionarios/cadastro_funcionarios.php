
<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 18:49:34 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-03 00:44:44
 */

?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../static/estilo.css">
    <title>Gopet</title>
</head>
<div id="formulario_funcionario">
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
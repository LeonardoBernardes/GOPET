<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 18:49:34 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-14 21:52:20
 */

?>
<<<<<<< HEAD
<form method="post" action="cadastrar_login.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastrar-se</legend><br/>
        <label>LOGIN : </label> 
        <input type="text" name="login" id="login"><br/>
        <label>EMAIL : </label> 
        <input type="text" name="email" id="email"><br/>
        <label>TIPO DE USUÁRIO : </label>      
        <select name="tipo_usuario">
            <!--option value="">ADMINISTRADOR</option-->
            <option value="4">EMPREENDIMENTOS</option>
            <option value="3">USUÁRIOS</option>
        </select> 
        <label>SENHA : </label> 
        <input type="password" name="senha" id="senha"><br/>
       
        <input type="submit" value="CADASTRAR">
    </fieldset>
</form>
=======
<!doctype html>
<html lang="pt-br">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="static/estilo.css">
    <title>Gopet</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
    <a class="navbar-brand logo" href="#" ><img src="static/imagens/gopet.png" alt="gopet"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">O projeto</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Contas
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#card_login">Login</a>
                    <a class="dropdown-item" href="cadastro_login.php">Criar uma conta</a>
                </div>
            </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
            <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
        </form>
    </div>
</nav>
<div class="one_page">
    <div class="container p-3 text-center">
        <h3 id="titulo_cadastrar">Criar uma conta</h3>
        <hr>
        <form method="post" action="cadastrar_login.php" id="formlogin" name="formlogin" >
            <fieldset id="fie">
                <legend>Cadastrar-se</legend><br/>
                <label>Login:</label>
                <input type="text" name="login" id="login"><br/>
                <label>E-mail</label>
                <input type="text" name="email" id="email"><br/>
                <label>Tipo de usuário</label>
                <select name="tipo_usuario">
                    <option value="1">Administrador</option>
                    <option value="2">Empreendimentos</option>
                    <option value="3">Usuários</option>
                    <option value="4">Administrador de empreendimentos</option>
                </select>
                <br>
                <label>Senha</label>
                <input type="password" name="senha" id="senha">
                <br><br>
                <input type="submit" class="btn btn-success btn-lg" value="Criar conta">
            </fieldset>
        </form>
    </div>
</div>
<!-- Optional JavaScript -->
<script src="static/jquery.js"></script>
<script src="static/bootstrap/js/bootstrap.js"></script>
</body>
</html>





>>>>>>> 18faf45b5a91645402b741818d3c2062d65f2a11

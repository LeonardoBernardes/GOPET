<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-09 01:19:46 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-29 18:28:38
 */
?>

<!doctype html>
<html lang="pt-br">

<head>

    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="../static/imagens/icon_preto.png">
    <title>GoPet</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../OPE/static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="static/estilo.css">


</head>

<body>
    <!-- Menu -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand logo" href="index.php"><img src="static/imagens/gopet.png" alt="gopet"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">O projeto</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#" data-toggle="modal" data-target="#card_login">Login</a>
                </li>
                <li>
                    <a class="nav-link" href="cadastro_login.php">Criar uma conta</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">

                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Pesquisar</button>
            </form>
        </div>
    </nav>

    <!-- Modal login -->
    <div class="modal fade" id="card_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                </div>
                <div class="modal-body text-center">
                    <form method="post" action="sessao.php" id="formlogin" name="formlogin">
                        <fieldset id="login_form">
                            <label>Nome </label><br>
                            <input class="form-control" type="text" name="login" id="login" /><br/>
                            <label>Senha </label><br>
                            <input class="form-control" type="password" name="senha" id="senha" /><br/>
                        </fieldset>
                        <br>
                        <input class="btn btn-outline-success btn-sm btn-block" type="submit" value="Login" />
                        <hr>
                        <p>Deseja se Cadastra-se? <a href="cadastro_login.php">clique aqui</a></p>
                        <div class="modal-footer">

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="static/jquery.js"></script>
    <script src="static/bootstrap/js/bootstrap.js"></script>
</body>

</html>


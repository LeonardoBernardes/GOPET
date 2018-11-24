<?php

/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-09 01:19:46 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-29 18:28:38
 */
session_start();
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
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="<?php echo $server_static?>static/estilo.css">
        


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
                
            </ul>

            <!--<form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Pesquisar" aria-label="Search">

                <button style="background:#4fdc6f; color:white;" class="btn" type="submit">Pesquisar</button>
            </form>-->
         <ul class="navbar-nav justify-content-end">   
        <?php if (!empty($_SESSION['grup_id'])){
                if ($_SESSION['grup_id'] == 2 || $_SESSION['grup_id'] == 4)
            { 
                if (!empty($_SESSION['grup_id'])){
                    echo '<li class="nav-item">
                                <a class="nav-link" href="empreendimentos/cadastro_empreendimentos.php">
                                     <i class="fa fa-user-circle fa-2x"></i>&nbsp; Meus Dados
                                </a>
                            </li>
                            <li class="nav-item active">
                                <a class="btn" href="logaut.php" ><img src="static/icones/sair.png" style="width:30px;" alt="gopet"/></a>
                            </li>
                            ';
                };
            }
          elseif($_SESSION['grup_id'] == 3)
          {
               if (!empty($_SESSION['grup_id'])){
                    echo '<li class="nav-item">
                                    <a class="nav-link" href="usuarios/cadastro_usuarios.php">
                                         <i class="fa fa-user-circle fa-2x"></i>&nbsp; Meus Dados
                                    </a>
                            </li>                            
                            <li class="nav-item active">
                                <a class="btn" href="logaut.php" ><img src="static/icones/sair.png" style="width:30px;" alt="gopet"/></a>
                            </li>
                            ';
               };
            };
        }else
            {
                echo'
            <li class="nav-item">
                <a class="nav-link" href="#" data-toggle="modal" data-target="#card_login">
                     <i class="fa fa-user-circle fa-2x"></i>&nbsp; Login
                </a>
            </li>
            <li>
                <a class="nav-link" href="cadastro_login.php">
                    <i class="fa fa-user-plus fa-2x"></i>&nbsp; Cadastrar
                </a>
            </li> 
            </ul>';
                
            }; 
        ?>
        </div>
    </nav>

    <!-- Modal login -->
    <div class="modal fade" id="card_login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">

                    <h5 align="center" class="modal-title" id="exampleModalLabel">Login</h5>
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
                        <input style="background:#4fdc6f; color:white;" class="btn btn-sm btn-block" type="submit" value="Login" />
                        <hr>
                        <p>Deseja se Cadastra-se? <a href="cadastro_login.php">clique aqui</a></p>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <script src="<?php echo $server_static?>static/jquery.js"></script>
    <script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script>
</body>

</html>


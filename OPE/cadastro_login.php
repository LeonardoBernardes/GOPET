<?php?>

<!doctype html>

<html lang="pt-br">

<head>
    
    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="./imagens/icon_preto.png">
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
    
    <!-- Icone da Pagina -->
    <link rel="icon" href="static/imagens/icon_preto.png">
    
</head>

<body>

<!-- Cadastro -->
<div class="formulario_login">
    <div class="container login-form"  >
        <h2 class="input-group-text" ><legend>Cadastrar-se</legend></h2>
        <div class="text-center border col-12" "input-group text-center">
            <form method="post" action="cadastrar_login.php" id="formlogin" name="formlogin" >
                <fieldset id="fie">
                    <label >Login  </label> 
                    <input class="input-group-text btn-lg btn-block" type="text" name="login" id="login"><br/>
                    <label>E-mail </label> 
                    <input class="input-group-text btn-lg btn-block" type="text" name="email" id="email"><br/>
                    <label>Tipo de Usuario  </label>      
                    <select class="input-group-text btn-lg btn-block" name="tipo_usuario">
                        <!--option value="">ADMINISTRADOR</option-->
                        <option  value="4">Empreendimento</option>
                        <option value="3">Usuário</option>
                    </select> <br/>
                    <label>Senha </label> 
                    <input class="input-group-text btn-lg btn-block" type="password" name="senha" id="senha"><br/>

                    <input class="btn btn-success btn-lg btn-block" type="submit" value="CADASTRAR">
                    <hr>
                    <p>Deseja se Logar? <a href="index.php">clique aqui</a></p>
                </fieldset>
            </form>
        </div>
    </div>
</div>



<!-- Footer -->
    
    

</body>
</html>


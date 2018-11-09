<?php
include_once 'config/server.php';

?>

<!doctype html>

<html lang="pt-br">


<?php
    
include_once ROOT_PATH."menu_footer/menu_principal.php"; 
    
?>
<body class="formulario_login">



<!-- Cadastro -->
<div >
    <div class="container login-form"  >
        <h2 class="input-group-text" ><legend>Cadastrar-se</legend></h2>
        <div class="text-center border col-12" "input-group text-center">
            <form method="post" action="cadastrar_login.php" id="formlogin" name="formlogin" >
                <fieldset id="fie"><br>
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

                    <input class="btn btn-success btn-lg btn-block" type="submit" value="Cadastrar">
                    <hr>
                    <p>Deseja se Logar? <a href="<?php echo $server_static;?>index.php">clique aqui</a></p>
                </fieldset>
            </form>
        </div>
    </div>
</div>



<!-- Footer -->
<footer>
<?php
    
include_once ROOT_PATH."menu_footer/footer.php" 
    ;
?>    
</footer>

</body>

</html>


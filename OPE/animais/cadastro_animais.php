<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 02:02:57
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';

/*$cidade="";
$bairro="";
$logradouro ="";


if(isset($_POST['valida-cep'])){
    
    $cep = $_POST['cep'];
    
    $ver = json_decode(file_get_contents("https://viacep.com.br/ws/".$cep."/json/"),true);
        $cidade = $ver['cidade'];
        $bairro = $ver['bairro'];
        $logradouro = $ver['logradouro'];
    
    header('refresh:0');
}*/



session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
 

//$foto = $_FILES["logo"];    
$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];

    if ($_SESSION['grup_id'] == 4){
    include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
    include_once(ROOT_PATH."menu_footer/menu_latera_empreendimento.php");
    }
    if ($_SESSION['grup_id'] == 1){    
        include_once(ROOT_PATH."menu_footer/menu_administrador.php");
    }
    if ($_SESSION['grup_id'] == 3){    
    include_once(ROOT_PATH."menu_footer/menu_usuario.php");
    include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");
    }
 
?>
<!-- Optional JavaScript -->    
<script src="<?php echo $server_static?>static/jquery.js"></script> 
<script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script> 



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

        <div class="container login-empreendimento">
            <form method="post" action="cadastrar_animais.php" id="formlogin" name="formlogin" enctype="multipart/form-data">
                    <h2 style="background:#4fdc6f; color:white;" class="btn btn-sm btn-block">
                        <legend>Cadastrar Animal</legend>
                    </h2><br>
                    <form method="post" action="cadastrar_animais.php?logi_id=<?php echo $logi_id ?>&grupo=<?php echo $grup_id ?>" id="formlogin" name="formlogin">
                        <fieldset id="fie">
                            <input type="radio" aria-label="Radio button for following text input" name="tipo_cadastro" value="2"> Resgate
                            <input type="radio" name="tipo_cadastro" value="1"> Doação
                            <input type="radio" name="tipo_cadastro" value="3"> Próprio
                            <br/>
                            <div class="card-group">
                                <div id="cadastro_animal_card" class="card">
                                    <label>Imagem 1: </label>
                                    <img class="card-img-top" src="" style="width:100px; heigth:50px;" alt='Foto de exibição' /><br />
                                    <input class="card-img-top" type="file" name="imagem1" id="imagem1"> <br/>
                                </div>

                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col">
                                    <label>Nome </label>
                                    <input class="form-control form-control-sm" type="text" name="nome" id="nome"><br/>
                                </div>
                                <div class="col">
                                    <label>R.G.A. </label>
                                    <input class="form-control form-control-sm" type="text" name="ra" id="ra"><br/>
                                </div>
                                <div class="col">
                                    <label>Idade  </label>
                                    <input class="form-control form-control-sm" type="text" name="idade" id="idade"><br/>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label>Porte  </label>
                                    <select class="form-control form-control-sm" name="porte">
                                        <option value="mini">Mini</option>
                                        <option value="pequeno">Pequeno</option>
                                        <option value="medio">Médio</option>
                                        <option value="grande">Grande</option>
                                        <option value="xgrande">Muito Grande</option>
                                    </select>
                                    <br/>
                                </div>
                                <div class="col">
                                    <label>Categoria  </label>
                                    <select class="form-control form-control-sm" name="categoria">
                                        <option value="cachorro">Cachorro</option>
                                        <option value="gato">Gato</option>
                                        <option value="coelho">Coelho</option>
                                        <option value="hamster">Hamster</option>
                                    </select>
                                    <br/>
                                </div>
                                <div class="col">
                                    <label>Restrição de Adoção : </label>
                                    <input class="form-control form-control-sm" type="text" name="restricao" id="restricao">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col">
                                    <label>Castrado  </label>
                                    <select class="form-control form-control-sm" name="castracao">
                                        <option name="castracao" value="2">Não indentificado</option>
                                        <option name="castracao" value="1">Sim</option>
                                        <option name="castracao" value="0">Não</option>
                                    </select>
                                </div>
                                <div class="col">
                                    <label>Gênero  </label>
                                    <select class="form-control form-control-sm" name="genero">
                                        <option name="genero" value="femea">Macho</option>
                                        <option type="radio" name="genero" value="macho">Fêmea</option>
                                    </select>
                                </div>
                            </div>
                            <br>
                            <fieldset id="fie">
                                <h2 style="background:#4fdc6f; color:white;" class="btn btn-sm btn-block">
                                    <legend>Endereço</legend>
                                </h2>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label>CEP:</label>
                                        <input class="form-control-sm" required type="text" name="cep" id="cep">
                                       <label>&nbsp;</label>
                                        <input type="button" style="background:#4fdc6f; color:white;" class="btn" value="Valida cep" onclick="valida_cep()">
                                    </div>
                                </div>
                                <br>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Pais  </label>
                                        <input class="form-control form-control-sm" value="BR" readonly type="text" name="pais" id="pais" maxlength="2"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Estado  </label>
                                        <input class="form-control form-control-sm" value="" readonly type="text" name="estado" id="estado" maxlength="2"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Cidade </label>
                                        <input class="form-control form-control-sm" type="text" readonly name="cidade" id="cidade"><br/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Bairro </label>
                                        <input class="form-control form-control-sm"  type="text" name="bairro"  id="bairro"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Logradouro </label>
                                        <input class="form-control form-control-sm" type="text"  name="logradouro" id="logradouro">
                                    </div>
                                    <div class="col">
                                        <label>Número  </label>
                                        <input class="form-control form-control-sm" type="text" name="numero" id="numero">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Complemento  </label>
                                        <input class="form-control form-control-sm" type="text" name="complemento" id="complemento"><br/>
                                    </div>
                                    
                                    
                                </div>
                            </fieldset>
                            <input style="background:#4fdc6f; color:white;" class="btn" type="submit" value="Cadastrar">
                       </fieldset>
                    </form>
            </form>
        </div>
    </div>
<script>
    //$(document).ready(function() {
        function valida_cep() {
            var cep = $('#cep').val();
            var ender = $.getJSON("https://viacep.com.br/ws/" + cep + "/json/", function(data) {
                var logradouro = ender["responseJSON"].logradouro;
                var localidade = ender["responseJSON"].localidade;
                var bairro = ender["responseJSON"].bairro;
                var uf = ender["responseJSON"].uf;
                $('#cidade').val(localidade);
                $('#estado').val(uf);
                $('#bairro').val(bairro);
                $('#logradouro').val(logradouro);
                console.log(ender['responseJSON']);
            });
        };
    //});
</script>
</body>
<footer>
    
    

    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");    
    
    ?>
      
        
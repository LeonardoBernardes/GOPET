<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 02:02:57
 */

include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');

session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
    }
 

//$foto = $_FILES["logo"];    
$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];
$logi_id = $_SESSION['logi_id'];

include_once "../menu_footer/menu_administrador.php" 
 
?>
<html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/estilo.css">
    <title>Gopet</title>
</head>

<body id="formulario_empreendimento">
<?php
if ($_SESSION['grup_id'] == 4){
include_once("../menu_footer/menu_empreendimento.php"); 
include_once "../menu_footer/menu_latera_empreendimento.php";
}
    

    
?>
    <div class="main">

        <div class="container login-empreendimento">
            <form method="post" action="cadastrar_animais.php" id="formlogin" name="formlogin" enctype="multipart/form-data">
                    <h2 class="btn btn-dark btn-sm btn-block">
                        <legend>Cadastrar Animal</legend>
                    </h2><br>
                    <form method="post" action="cadastrar_animais.php?logi_id=<?php echo $logi_id ?>&grupo=<?php echo $grup_id ?>" id="formlogin" name="formlogin">
                        <fieldset id="fie">
                            <input type="radio" aria-label="Radio button for following text input" name="tipo_cadastro" value="resgate"> Resgate
                            <input type="radio" name="tipo_cadastro" value="doacao"> Doação
                            <input type="radio" name="tipo_cadastro" value="proprio"> Próprio
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
                                    <label>R.A </label>
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
                            <hr/>
                            <fieldset id="fie">
                                <h2 class="btn btn-dark btn-sm btn-block">
                                    <legend>Endereço</legend>
                                </h2>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Pais  </label>
                                        <input class="form-control form-control-sm" type="text" name="pais" id="pais"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Estado  </label>
                                        <input class="form-control form-control-sm" type="text" name="estado" id="estado"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Cidade </label>
                                        <input class="form-control form-control-sm" type="text" name="cidade" id="cidade"><br/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Bairro </label>
                                        <input class="form-control form-control-sm" type="text" name="bairro" id="bairro"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Logradouro </label>
                                        <input class="form-control form-control-sm" type="text" name="logradouro" id="logradouro">
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
                                    <div class="col">
                                        <label>CEP  </label>
                                        <input class="form-control form-control-sm" type="text" name="cep" id="cep"><br/>
                                    </div>
                                </div>
                            </fieldset>
                            <input class="btn btn-success btn-sm btn-block" type="submit" value="Cadastrar">
                        <hr>
                        <a class="btn btn-dark btn-sm btn-block" href="consulta_animais.php"> Voltar</a>
                       </fieldset>
                    </form>
            </form>
        </div>
    </div>
</body>
<footer>

    <?php 
    include_once("../menu_footer/footer.php");    
    
    ?>

</footer>
       
</html>      
        
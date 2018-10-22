
<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-13 18:57:09
 */

include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }


    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
$logi_id = $_SESSION['logi_id'];
$logado = $_SESSION['login'];
$grup_id = $_SESSION['grup_id'];

$anim_id = $_GET['id'];


$dados_empr = $endereco_empr = array();
//dados
$empr_cnpj = $empr_nome = $empr_dt_abertura = $empr_objetivo = '';
$empr_slogan = $empr_responsavel = $empr_status = $empr_logo = '';
//endereco
$emen_logradouro = $emen_complemento = $emen_pais = $emen_estado = $emen_estado = $endereco_img ='';
$emen_numero = $emen_cep = 0;   
$emen_cidade = $emen_bairro = '';   
$tipo_cadastro_animal = '';

if(!empty($anim_id)){

    $sql="  SELECT 
                animais.anim_nome,
                animais.anim_ra,
                animais.anim_idade,
                animais.anim_porte,
                animais.anim_genero,
                animais.anim_categoria,
                animais.anim_restricao_doacao,
                animais.anim_castracao,
                animais_endereco.anen_logradouro,
                animais_endereco.anen_numero,
                animais_endereco.anen_complemento,
                animais_endereco.anen_bairro,
                animais_endereco.anen_cidade,
                animais_endereco.anen_estado,
                animais_endereco.anen_pais,
                animais_endereco.anen_cep,
                animais_fotos.anfo_endereco
            FROM 
                animais 
                LEFT JOIN animais_endereco on animais.anim_id = animais_endereco.anim_id 
                LEFT JOIN animais_fotos on animais.anim_id = animais_fotos.anim_id
            WHERE 
                animais.anim_id = $anim_id";
                 
    $result2 =  mysqli_query($conn, $sql);
    $row3 = mysqli_fetch_object($result2);
   
    if(!empty($row3)){

        if($grup_id == 3){

            //Recuperar id do usuario que quer cadastrar animal
            $sql2 = "   SELECT
                            usan_flag as flag_animal
                        FROM
                            usuarios_x_animais
                        WHERE
                            anim_id = $anim_id   
            ";
            $result = mysqli_query($conn, $sql2);
            $flag = mysqli_fetch_object($result);

        }elseif($grup_id == 4 || $grup_id == 2){

                //Recuperar id do empreendimento que quer cadastrar animal
            $sql2 = "   SELECT
                            eman_flag as flag_animal
                        FROM
                            empreendimentos_x_animais
                        WHERE
                            anim_id = $anim_id
                        ";
                        echo $sql2;
            $result = mysqli_query($conn, $sql2);
            $flag = mysqli_fetch_object($result);
        }

        $anim_nome = $row3->anim_nome;
        $anim_ra = $row3->anim_ra;
        $anim_idade = $row3->anim_idade;
        $anim_porte = $row3->anim_porte;
        $anim_genero = $row3->anim_genero;
        $anim_categoria = $row3->anim_categoria;
        $anim_restricao_doacao = $row3->anim_restricao_doacao;
        $anim_castracao = $row3->anim_castracao;
        $anen_logradouro = $row3->anen_logradouro;
        $anen_numero = $row3->anen_numero;
        $anen_complemento = $row3->anen_complemento;
        $anen_bairro = $row3->anen_bairro;
        $anen_cidade = $row3->anen_cidade;
        $anen_estado = $row3->anen_estado;
        $anen_pais = $row3->anen_pais;
        $anen_cep = $row3->anen_cep;

        if(!empty($flag)){
            $flag_animal = $flag->flag_animal;
        }else{
            $flag_animal = 3;
        }
        if($flag_animal == 1){
            $tipo_cadastro_animal .='
                <input type="radio" aria-label="Radio button for following text input" name="tipo_cadastro" value="2"> Resgate
                <input type="radio" name="tipo_cadastro" value="1" checked> Doação
                <input type="radio" name="tipo_cadastro" value="3"> Próprio';

        }elseif($flag_animal == 2){
            $tipo_cadastro_animal .='
                <input type="radio" aria-label="Radio button for following text input" name="tipo_cadastro" value="2" checked> Resgate
                <input type="radio" name="tipo_cadastro" value="1"> Doação
                <input type="radio" name="tipo_cadastro" value="3"> Próprio';
        }else{
            $tipo_cadastro_animal .='
                <input type="radio" aria-label="Radio button for following text input" name="tipo_cadastro" value="2" > Resgate
                <input type="radio" name="tipo_cadastro" value="1"> Doação
                <input type="radio" name="tipo_cadastro" value="3" checked> Próprio';
        }
       

        $endereco_img = $row3->anfo_endereco;
        
        //Criar Funcao para trazer local host como variavel
        $endereco_img = str_replace('\\', '/',$server_static.'animais/'.$endereco_img);
    }

    
}//var_dump(str_replace('/', '\'',$endereco_img));     


    if ($_SESSION['grup_id'] == 4 || $_SESSION['grup_id'] == 2){
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
            <form method="post" action="update_animais.php?anim_id=<?php echo $anim_id ?>" id="formlogin" name="formlogin" enctype="multipart/form-data">
                    <h2 class="btn btn-dark btn-sm btn-block">
                        <legend>Atualizar Animal</legend>
                    </h2><br>
                    <form method="post" action="update_animais.php" id="formlogin" name="formlogin">
                        <fieldset id="fie">
                            <?php echo $tipo_cadastro_animal ?>
                            <br/>
                            <div class="card-group">
                                <div id="cadastro_animal_card" class="card">
                                    <label>Imagem: </label>
                                    <img class="card-img-top" src="<?php echo $endereco_img; ?>" style="width:100px; heigth:50px;" alt='Foto de exibição' /><br />
                                    <input class="card-img-top" type="file" name="imagem1" id="imagem1"> <br/>
                                </div>

                            </div>
                            <hr>
                            <div class="form-row">
                                <div class="col">
                                    <label>Nome </label>
                                    <input class="form-control form-control-sm" type="text" name="nome" id="nome" value="<?php echo $anim_nome ?>"><br/>
                                </div>
                                <div class="col">
                                    <label>R.G.A. </label>
                                    <input class="form-control form-control-sm" type="text" name="ra" id="ra" value="<?php echo $anim_ra ?>"><br/>
                                </div>
                                <div class="col">
                                    <label>Idade  </label>
                                    <input class="form-control form-control-sm" type="text" name="idade" id="idade" value="<?php echo $anim_idade ?>"><br/>
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
                                    <input class="form-control form-control-sm" type="text" name="restricao" id="restricao" value="<?php echo $anim_restricao_doacao ?>">
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
                                        <input class="form-control form-control-sm" type="text" name="pais" id="pais" value="<?php echo $anen_pais ?>" maxlength="2"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Estado  </label>
                                        <input class="form-control form-control-sm" type="text" name="estado" id="estado" value="<?php echo $anen_estado ?>" maxlength="2"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Cidade </label>
                                        <input class="form-control form-control-sm" type="text" name="cidade" id="cidade" value="<?php echo $anen_cidade ?>"><br/>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Bairro </label>
                                        <input class="form-control form-control-sm" type="text" name="bairro" id="bairro" value="<?php echo $anen_bairro ?>"><br/>
                                    </div>
                                    <div class="col">
                                        <label>Logradouro </label>
                                        <input class="form-control form-control-sm" type="text" name="logradouro" id="logradouro" value="<?php echo $anen_logradouro ?>">
                                    </div>
                                    <div class="col">
                                        <label>Número  </label>
                                        <input class="form-control form-control-sm" type="text" name="numero" id="numero" value="<?php echo $anen_numero ?>">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="col">
                                        <label>Complemento  </label>
                                        <input class="form-control form-control-sm" type="text" name="complemento" id="complemento" value="<?php echo $anen_complemento ?>"><br/>
                                    </div>
                                    <div class="col">
                                        <label>CEP  </label>
                                        <input class="form-control form-control-sm" type="text" name="cep" id="cep" value="<?php echo $anen_cep ?>"><br/>
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
    include_once(ROOT_PATH."menu_footer/footer.php");    
    
    ?>

</footer>
       
</html>      
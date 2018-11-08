
<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-29 12:46:22
 */

include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';
//session_start();
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
$dados_usua = $endereco_usua = array();
//dados
$usua_cpf = $usua_nome = $usua_sobrenome = $usua_dt_nascimento = '';
$usua_status  = '';
//endereco
$usua_logradouro = $usua_complemento = $usua_pais = $usua_estado = $usua_estado = '';
$usua_numero = $usua_cep = 0;   
$usua_cidade = $usua_bairro = '';   
    
$endereco_img = '';       

$query= " SELECT usua_id from login_x_usuarios where logi_id= $logi_id";
//echo $query;

$result = mysqli_query($conn, $query);
$row2 = mysqli_fetch_object($result);

if(!empty($row2)){

    $sql="  SELECT 
                usua_cpf,
                usua_nome,
                usua_sobrenome,
                usua_dt_nascimento,
                usua_status
            FROM usuarios WHERE usua_id = $row2->usua_id";
    $result2 =  mysqli_query($conn, $sql);

    while($row3 = mysqli_fetch_object($result2)){

        $usua_cpf = $row3->usua_cpf;
        $usua_nome = $row3->usua_nome;
        $usua_sobrenome = $row3->usua_sobrenome;
        $usua_dt_nascimento = $row3->usua_dt_nascimento;
        $usua_status = $row3->usua_status;
    }
    $sql2=" SELECT 
                usen_logradouro,
                usen_numero,
                usen_complemento,
                usen_pais,
                usen_estado,
                usen_cidade,
                usen_bairro,
                usen_cep
            FROM 
                usuarios_enderecos 
            WHERE 
                usua_id = $row2->usua_id";
    //echo $sql2;
    $result3 =  mysqli_query($conn, $sql2);
    if(!empty($result3)){
        while($row4 = mysqli_fetch_object($result3)){

            $usua_logradouro = $row4->usen_logradouro;
            $usua_numero = $row4->usen_numero;
            $usua_complemento = $row4->usen_complemento;
            $usua_pais = $row4->usen_pais;
            $usua_estado = $row4->usen_estado;
            $usua_cidade = $row4->usen_cidade;
            $usua_bairro = $row4->usen_bairro;
            $usua_cep = $row4->usen_cep;
        }
    }
    // Retorna imagem se possuir cadastrada
    $sql3=" SELECT 
                usim_endereco
            FROM 
                usuarios_imagens 
            WHERE 
                usua_id = $row2->usua_id";
    //echo $sql3;
    $result4 =  mysqli_query($conn, $sql3);
    $row5 = mysqli_fetch_object($result4);

    if(!empty($row5)){
        $endereco_img = $row5->usim_endereco;
    }
    //Criar Funcao para trazer local host como variavel
    $endereco_img = str_replace('\\', '/',$server_static.'usuarios/'.$endereco_img);
}//var_dump(str_replace('/', '\'',$endereco_img));     
?>
    <!-- Optional JavaScript -->
    <script src="<?php echo $server_static?>static/jquery.js"></script>
    <script src="<?php echo $server_static?>static/bootstrap/js/bootstrap.js"></script>
<html>

<head>

    <!-- Icone da Pagina & Titulo -->
    <link rel="icon" href="<?php echo $server_static;?>static/imagens/icon_preto.png">
    <title>GoPet</title>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">

    <!--icones legais para colocar no site https://fontawesome.com/icons?d=gallery -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <!-- GOPET CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
        


</head>
<body>
<?php
 include_once(ROOT_PATH."menu_footer/menu_latera_usuario.php");    
 include_once(ROOT_PATH."menu_footer/menu_usuario.php"); 
?>

<div id="formulario_empreendimento">
     <div class="main">    
           <div class="container login-empreendimento">
            <form method="post" action="cadastrar_usuarios.php" id="formlogin" name="formlogin" enctype="multipart/form-data">
                <fieldset id="fie">
                    <h2 class="btn btn-dark btn-sm btn-block">
                        <legend>Dados Usuario</legend>
                    </h2><br>
                    <div class="card-group">
                        <div id="cadastro_animal_card" class="card">
                            <img src="<?php echo $endereco_img ?>" style="width:250px; heigth:50px;" alt='Foto de exibição' /><br />
                            <input type="file" name="logo" id="logo"> <br/>
                        </div>
                    </div>
                    <hr>
                    <div class="form-row">
                        <div class="col">
                            <label>Nome </label>
                            <input class="form-control form-control-sm" type="text" name="nome" id="nome" value='<?php echo $usua_nome ?>'>
                        </div>
                        <div class="col">
                            <label>CPF </label>
                            <input class="form-control form-control-sm" type="text" name="cpf" id="cpf" value='<?php echo $usua_cpf ?>'>
                        </div>
                        <div class="col">
                            <label>Sobrenome </label>
                            <input class="form-control form-control-sm" type="text" name="sobrenome" id="sobrenome" value='<?php echo $usua_sobrenome ?>'>
                        </div>
                        <div class="col">
                            <label>Data nascimento </label>
                            <input class="form-control form-control-sm" type="text" name="data_nascimento" id="data_nascimento" value='<?php echo $usua_dt_nascimento ?>'>
                        </div>
                    </div>
                    <fieldset id="fie"><br>
                        <hr>

                        <h2 class="btn btn-dark btn-sm btn-block">
                            <legend>Endereço</legend>
                        </h2>
                        <div class="form-row">
                            <div class="col">
                                <label>Cidade</label>
                                <input class="form-control form-control-sm" type="text" name="cidade" id="cidade" value='<?php echo $usua_cidade ?>'>
                            </div>
                            <div class="col">
                                <label>Estado: </label> // só sigla
                                <input class="form-control form-control-sm" type="text" name="estado" id="estado" value='<?php echo $usua_estado ?>'>
                            </div>
                            <div class="col">
                                <label>Pais: // só sigla </label>
                                <input class="form-control form-control-sm" type="text" name="pais" id="pais" value='<?php echo $usua_pais ?>'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Bairro  </label>
                                <input class="form-control form-control-sm" type="text" name="bairro" id="bairro" value='<?php echo $usua_bairro ?>'>
                            </div>
                            <div class="col">
                                <label>Logradouro  </label>
                                <input class="form-control form-control-sm" type="text" name="logradouro" id="logradouro" value='<?php echo $usua_logradouro ?>'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Número  </label>
                                <input class="form-control form-control-sm" type="text" name="numero" id="numero" value='<?php echo $usua_numero ?>'>
                            </div>
                            <div class="col">
                                <label>Complemento  </label>
                                <input class="form-control form-control-sm" type="text" name="complemento" id="complemento" value='<?php echo $usua_complemento ?>'>
                            </div>
                            <div class="col">
                                <label>CEP  </label>
                                <input class="form-control form-control-sm" type="text" name="cep" id="cep" value='<?php echo $usua_cep ?>'>
                            </div>
                        </div>
                    </fieldset>
                    <hr>
                    <input class="btn btn-success btn-sm btn-block" type="submit" value="Salvar Dados">
                    <hr>
                    <a class="btn btn-dark btn-sm btn-block" href="<?php echo $server_static;?>usuarios/home_usuarios.php"> Voltar</a>
                </fieldset>

            </form>
        </div>
        </div>
    </div>


</body>
<footer>


    <?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>

</footer>

</html>
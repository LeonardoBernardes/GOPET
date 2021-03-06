
<?php 
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-13 18:57:09
 */
include_once(ROOT_PATH."menu_footer/menu_empreendimento.php"); 
include_once ROOT_PATH .'mysql_conexao/conexao_mysql.php';
//session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:'.$server_static.'index.php');
    }
$logi_id = $_SESSION['logi_id'];
$logado = $_SESSION['login'];
$dados_empr = $endereco_empr = array();
//dados
$empr_cnpj = $empr_nome = $empr_dt_abertura = $empr_objetivo = '';
$empr_slogan = $empr_responsavel = $empr_status = $empr_logo = '';
//endereco
$emen_logradouro = $emen_complemento = $emen_pais = $emen_estado = $emen_estado = $endereco_img ='';
$emen_numero = $emen_cep = 0;   
$emen_cidade = $emen_bairro = '';   
    

        

$query= " SELECT empr_id from login_x_empreendimentos where logi_id= $logi_id";
//echo $query;

$result = mysqli_query($conn, $query);
$row2 = mysqli_fetch_object($result);

if(!empty($row2)){

    $sql="  SELECT 
                empr_cnpj,
                empr_nome,
                empr_dt_abertura,
                empr_objetivo,
                empr_slogan,
                empr_responsavel,
                empr_status,
                empr_logo
            FROM empreendimentos WHERE empr_id = $row2->empr_id";
    $result2 =  mysqli_query($conn, $sql);

    while($row3 = mysqli_fetch_object($result2)){

        $empr_cnpj = $row3->empr_cnpj;
        $empr_nome = $row3->empr_nome;
        $empr_dt_abertura = $row3->empr_dt_abertura;
        $empr_objetivo = $row3->empr_objetivo;
        $empr_slogan = $row3->empr_slogan;
        $empr_responsavel = $row3->empr_responsavel;
        $empr_status = $row3->empr_status;
        $empr_logo = $row3->empr_logo;
    }
    $sql2=" SELECT 
                emen_logradouro,
                emen_numero,
                emen_complemento,
                emen_pais,
                emen_estado,
                emen_cidade,
                emen_bairro,
                emen_cep
            FROM 
                empreendimentos_enderecos 
            WHERE 
                empr_id = $row2->empr_id";
    //echo $sql2;
    $result3 =  mysqli_query($conn, $sql2);
    while($row4 = mysqli_fetch_object($result3)){

        $emen_logradouro = $row4->emen_logradouro;
        $emen_numero = $row4->emen_numero;
        $emen_complemento = $row4->emen_complemento;
        $emen_pais = $row4->emen_pais;
        $emen_estado = $row4->emen_estado;
        $emen_cidade = $row4->emen_cidade;
        $emen_bairro = $row4->emen_bairro;
        $emen_cep = $row4->emen_cep;
    }
    // Retorna imagem se possuir cadastrada
    $sql3=" SELECT 
                emim_endereco
            FROM 
                empreendimentos_imagens 
            WHERE 
                empr_id = $row2->empr_id";
    //echo $sql3;
    $result4 =  mysqli_query($conn, $sql3);
    $row5 = mysqli_fetch_object($result4);

    if(!empty($row5)){
        $endereco_img = $row5->emim_endereco;
    }
    //Criar Funcao para trazer local host como variavel
    $endereco_img = str_replace('\\', '/',$server_static.'empreendimentos/'.$endereco_img);
}//var_dump(str_replace('/', '\'',$endereco_img));     
?>

<html>

<head>
<script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

</head>
    

<body id="formulario_empreendimento">
<?php
    
include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php" 
    
?>

    <div class="main">
        <div class="container login-empreendimento">
            <form method="post" action="cadastrar_empreendimento.php" id="formlogin" name="formlogin" enctype="multipart/form-data">
                <fieldset id="fie">
                    <h2 style="background:#4fdc6f; color:white;" class="btn btn-lg btn-block">
                        <legend>Dados Estabelecimento</legend>
                    </h2><br>
                    <div class="card-group">
                        <div id="cadastro_animal_card" class="card">
                            <img src="<?php echo $endereco_img ?>" style="width:150; heigth:50px;" alt='Foto de exibição' /><br />
                            <input type="file" name="logo" id="logo"> <br/>
                        </div>
                    </div>
                    <br>
                    <div class="form-row">
                        <div class="col">
                            <label>Nome </label>
                            <input class="form-control form-control-sm" type="text" name="nome" id="nome" value='<?php echo $empr_cnpj ?>'>
                        </div>
                        <div class="col">
                            <label>Cnpj </label>
                            <input class="form-control form-control-sm" type="text" name="cnpj" id="cnpj" value='<?php echo $empr_nome ?>'>
                        </div>
                        <div class="col">
                            <label>Data Abertura </label>
                            <input class="form-control form-control-sm" type="date" name="data_abertura" id="data_abertura" value='<?php echo $empr_dt_abertura ?>'>
                        </div>
                        <div class="col">
                            <label>Responsavel </label>
                            <input class="form-control form-control-sm" type="text" name="responsavel" id="responsavel" value='<?php echo $empr_responsavel ?>'>
                        </div>
                    </div>
                    <label>Objetivo </label>
                    <input class="form-control form-control-sm" type="text" name="objetivo" id="objetivo" value='<?php echo $empr_objetivo ?>'>
                    <label>Slogan : </label>
                    <input class="form-control form-control-sm" type="text" name="slogan" id="slogan" value='<?php echo $empr_slogan ?>'>

                    <fieldset id="fie"><br>

                        <h2 style="background:#4fdc6f; color:white;" class="btn btn-lg btn-block">
                            <legend>Endereço</legend>
                        </h2>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label>CEP:</label>
                                <input class="form-control-sm" required type="text" name="cep" id="cep" value='<?php echo $emen_cep ?>'>
                               <label>&nbsp;</label>
                                <input type="button" style="background:#4fdc6f; color:white;" class="btn" value="Valida cep" onclick="valida_cep()">
                            </div>
                            </div>
                        <br>
                        <div class="form-row">
                            <div class="col">
                                <label>Cidade</label>
                                <input class="form-control form-control-sm" readonly type="text" name="cidade" id="cidade" value='<?php echo $emen_cidade ?>'>
                            </div>
                            <div class="col">
                                <label>Estado: </label> 
                                <input class="form-control form-control-sm" readonly type="text" name="estado" id="estado" value='<?php echo $emen_estado ?>' maxlength="2">
                            </div>
                            <div class="col">
                                <label>Pais:  </label> 
                                <input class="form-control form-control-sm" readonly type="text" name="pais" id="pais" value='BR' maxlength="2">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Bairro  </label>
                                <input class="form-control form-control-sm" type="text" name="bairro" id="bairro" value='<?php echo $emen_bairro ?>'>
                            </div>
                            <div class="col">
                                <label>Logradouro  </label>
                                <input class="form-control form-control-sm" type="text" name="logradouro" id="logradouro" value='<?php echo $emen_logradouro ?>'>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="col">
                                <label>Número  </label>
                                <input class="form-control form-control-sm" type="text" name="numero" id="numero" value='<?php echo $emen_numero ?>'>
                            </div>
                            <div class="col">
                                <label>Complemento  </label>
                                <input class="form-control form-control-sm" type="text" name="complemento" id="complemento" value='<?php echo $emen_complemento ?>'>
                            </div>
                            
                        </div>
                    </fieldset>
                    <br>
                    <input style="background:#4fdc6f; color:white;" class="btn" type="submit" value="Salvar Dados">
                </fieldset>

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

</footer>

</html>
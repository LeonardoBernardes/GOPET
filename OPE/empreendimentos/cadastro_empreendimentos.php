
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 01:26:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-30 19:23:41
 */
include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
session_start();
    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        header('location:index.php');
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
    $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/'.$endereco_img);
}//var_dump(str_replace('/', '\'',$endereco_img));     
?>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/estilo.css">
    <title>Gopet</title>
</head>

<div id="formulario_empreendimento">
    <div class="container login-empreendimento"  >
    <form method="post" action="cadastrar_empreendimento.php" id="formlogin" name="formlogin" enctype="multipart/form-data" >
    <fieldset id="fie">
        <h2 class="alert alert-danger"><legend>Dados Empreendimento</legend></h2><br>
        <img src="<?php echo $endereco_img ?>" style="width:250px; heigth:50px;" alt='Foto de exibição' /><br />
        <input type="file" name="logo" id="logo" > <br/>
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
                <input class="form-control form-control-sm" type="text" name="data_abertura" id="data_abertura" value='<?php echo $empr_dt_abertura ?>'>
            </div>
               <div class="col"> 
                    <label>Responsavel : </label> 
                    <input class="form-control form-control-sm" type="text" name="responsavel" id="responsavel" value='<?php echo $empr_responsavel ?>'>
               </div>
        </div>
        <label>Objetivo </label> 
        <input class="form-control form-control-sm" type="text" name="objetivo" id="objetivo" value='<?php echo $empr_objetivo ?>'>
        <label>Slogan : </label> 
        <input class="form-control form-control-sm" type="text" name="slogan" id="slogan" value='<?php echo $empr_slogan ?>'>
       
        <fieldset id="fie"><br><hr>
        
        <h2 class="alert alert-danger"><legend>Endereço</legend></h2> 
        <div class="form-row">
            <div class="col">
               <label>Cidade</label> 
                <input class="form-control form-control-sm" type="text" name="cidade" id="cidade" value='<?php echo $emen_cidade ?>'>
            </div>
            <div class="col">
                <label>Estado: </label> // só sigla
                <input class="form-control form-control-sm" type="text" name="estado" id="estado" value='<?php echo $emen_estado ?>'>
            </div>
            <div class="col">
                <label>Pais: // só sigla </label> 
                <input class="form-control form-control-sm"  type="text" name="pais" id="pais" value='<?php echo $emen_pais ?>'>
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
                <div class="col">
                    <label>CEP  </label> 
                    <input class="form-control form-control-sm" type="text" name="cep" id="cep" value='<?php echo $emen_cep ?>'>
                </div>
            </div>
        </fieldset>
        <hr>
        <input class="btn btn-success btn-lg btn-block" type="submit" value="Salvar Dados"><hr>
         <a class="btn btn-dark btn-lg btn-block" href="../empreendimentos/home_empreendimento.php"> Voltar</a>
    </fieldset>
    
</form>
    </div>
</div>
<a href="..\logaut.php">LOGAUT</a>

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
<form method="post" action="cadastrar_empreendimento.php" id="formlogin" name="formlogin" enctype="multipart/form-data" >
    <fieldset id="fie">
        <legend>Dados Empreendimento</legend><br/>
        <label>LOGO : </label> 
        <img src="<?php echo $endereco_img ?>" style="width:400px; heigth:50px;" alt='Foto de exibição' /><br />
        <input type="file" name="logo" id="logo" > <br/>
        <label>NOME : </label> 
        <input type="text" name="nome" id="nome" value='<?php echo $empr_cnpj ?>'> <br/>
        <label>CNPJ : </label> 
        <input type="text" name="cnpj" id="cnpj" value='<?php echo $empr_nome ?>'><br/>
        <label>Data Abertura : </label> 
        <input type="text" name="data_abertura" id="data_abertura" value='<?php echo $empr_dt_abertura ?>'><br/>
        <label>Objetivo : </label> 
        <input type="text" name="objetivo" id="objetivo" value='<?php echo $empr_objetivo ?>'><br/>
        <label>Slogan : </label> 
        <input type="text" name="slogan" id="slogan" value='<?php echo $empr_slogan ?>'><br/>
        <label>Responsavel : </label> 
        <input type="text" name="responsavel" id="responsavel" value='<?php echo $empr_responsavel ?>'><br/>
        <fieldset id="fie">
        <legend>Endereço</legend><br/>
     
        <label>Pais : // só sigla </label> 
        <input type="text" name="pais" id="pais" value='<?php echo $emen_pais ?>'><br/>
        <label>Estado : </label> // só sigla
        <input type="text" name="estado" id="estado" value='<?php echo $emen_estado ?>'><br/>
        <label>Cidade : </label> 
        <input type="text" name="cidade" id="cidade" value='<?php echo $emen_cidade ?>'><br/>
        <label>Bairro : </label> 
        <input type="text" name="bairro" id="bairro" value='<?php echo $emen_bairro ?>'><br/>
        <label>Logradouro : </label> 
        <input type="text" name="logradouro" id="logradouro" value='<?php echo $emen_logradouro ?>'><br/>
        <label>Número : </label> 
        <input type="text" name="numero" id="numero" value='<?php echo $emen_numero ?>'><br/>
        <label>Complemento : </label> 
        <input type="text" name="complemento" id="complemento" value='<?php echo $emen_complemento ?>'><br/>
        <label>CEP : </label> 
        <input type="text" name="cep" id="cep" value='<?php echo $emen_cep ?>'><br/>
        </fieldset>
        <input type="submit" value="Salvar Dados">
        
    </fieldset>
    <a href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
</form>
<a href="..\logaut.php">LOGAUT</a>
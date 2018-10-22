<?php
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:51:21
 */
include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.'index.php');
    }
 
$logado = $_SESSION['login'];
$serv_id = $_GET['id'];
$ativado = $desativado ='';

$sql="  SELECT 
            serv_id,
            serv_nome,
            serv_descricao,
            serv_valor_total,
            serv_promocao,
            serv_valor_promocao,
            serv_status,
            empr_id
        FROM 
            `servicos` 
        WHERE 
            `serv_id` = '$serv_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);

if($row->serv_status == 1){
    $ativado = "selected";
}else{
    $desativado = "selected";
}

// Retorna imagem se possuir cadastrada
$sql3=" SELECT 
            seim_endereco
        FROM 
            servicos_imagens 
        WHERE 
            empr_id = $row->empr_id
            AND serv_id = $row->serv_id";
    //echo $sql3;
$result4 =  mysqli_query($conn, $sql3);
$row5 = mysqli_fetch_object($result4);

$endereco_img = '';
if(!empty($row5)){
    $endereco_img = $row5->seim_endereco;
}
if(!empty($endereco_img)){
//Criar Funcao para trazer local host como variavel
$endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/servicos/'.$endereco_img);
}

include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php" ;
include_once ROOT_PATH."menu_footer/menu_empreendimento.php" ;
?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
    
    
</head>
<body id="formulario_funcionario">
<div class="main">
    <div class="container login-form"  >
        <h2 class="alert alert-warning" ><legend>Cadastrar Funcionário</legend></h2>

    <form method="post" action="update_servicos.php?id=<?= $serv_id ?>" id="formlogin" name="formlogin" enctype="multipart/form-data">
    <fieldset id="fie">
        <legend>Atualizar Serviço</legend><br/>
        <label>Imagem : </label> 
        <img src="<?php echo $endereco_img ?>" style="width:400px; heigth:50px;" alt='Foto de exibição' /><br />
        <input type="file" name="imagem" id="imagem" > <br/>
        <label>Nome : </label> 
        <input class="input-group-text btn-lg btn-block" type="text" name="nome" id="nome" value="<?php echo ($row->serv_nome) ? $row->serv_nome : "" ?>"><br/>
        <label>Descrição : </label> 
        <input class="input-group-text btn-lg btn-block" type="text" name="descricao" id="descricao" value="<?php echo ($row->serv_descricao) ? $row->serv_descricao : "" ?>"><br/>
        <label>Valor Total : </label> 
        <input class="input-group-text btn-lg btn-block" type="number" name="valor_total" id="valor_total" value="<?php echo ($row->serv_valor_total) ? $row->serv_valor_total : 0 ?>"><br/>
        <label>Possuí Promoção ? </label> 
        <select class="input-group-text btn-lg btn-block" name="promocao">
            <option value="0">Não</option>
            <option value="1">SIM</option>
        </select>
        <label>Valor Promoção : </label> 
        <input class="input-group-text btn-lg btn-block" type="text" name="valor_promocao" id="valor_promocao" value="<?php echo ($row->serv_valor_promocao) ? $row->serv_valor_promocao : "" ?>"><br/>
        <label>Status : </label> 
        <select class="input-group-text btn-lg btn-block" name="status">
            <option value="1" <?php echo $ativado ?>>Ativo</option>
            <option value="0" <?php echo $desativado ?>>Desativado</option>
        </select>
        <input class="btn btn-success btn-lg btn-block" type="submit" value="Atualizar Serviço">
        
    </fieldset>
    </div>
</div>
</div>
    
</form>
</body>
<?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>
<a href="..\servicos\consultar_servicos.php"> Voltar</a>
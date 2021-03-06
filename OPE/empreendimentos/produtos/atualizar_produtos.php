<?php
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:51:45
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
$prod_id = $_GET['id'];
$ativado = $desativado ='';

$sql="  SELECT 
            prod_id,
            prod_nome,
            prod_marca,
            prod_qtde_estoque,
            prod_descricao,
            prod_valor_total,
            prod_promocao,
            prod_valor_promocao,
            prod_status,
            empr_id
        FROM 
            `produtos` 
        WHERE 
            `prod_id` = '$prod_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);

if($row->prod_status == 1){
    $ativado = "selected";
}else{
    $desativado = "selected";
}

// Retorna imagem se possuir cadastrada
$sql3=" SELECT 
            prim_endereco
        FROM 
            produtos_imagens 
        WHERE 
            empr_id = $row->empr_id
            AND prod_id = $row->prod_id";
    //echo $sql3;
$result4 =  mysqli_query($conn, $sql3);
$row5 = mysqli_fetch_object($result4);

$endereco_img = '';
if(!empty($row5)){
    $endereco_img = $row5->prim_endereco;
}
if(!empty($endereco_img)){
//Criar Funcao para trazer local host como variavel
$endereco_img = str_replace('\\', '/',$server_static.'empreendimentos/produtos/'.$endereco_img);
}

    
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
<body >
<?php include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php"; ?>
<div class="main">
    <div class="container atualizarProduto">
        <h2 style="background:#4fdc6f; color:white;" class="btn btn-sm btn-block" ><legend>Atualizar Produto</legend></h2>
<form method="post" action="update_produtos.php?id=<?= $prod_id ?>" id="formlogin" name="formlogin" enctype="multipart/form-data">
    <fieldset id="fie">
        <label>Imagem : </label> 
        <img src="<?php echo $endereco_img ?>"  style="width:100px;" alt='Foto de exibição' /><br />
        <input class="input-group-text btn-dark btn-sm " type="file" name="imagem" id="imagem" > <br/>
        <div class="form-row">
            <div class="col">
                <label>Nome : </label> 
                <input class="input-group-text btn-lg btn-block" type="text" name="nome" id="nome" value="<?php echo ($row->prod_nome) ? $row->prod_nome : "" ?>"><br/>
            </div>
            <div class="col">
                <label>Marca : </label> 
                <input class="input-group-text btn-lg btn-block" type="text" name="marca" id="marca" value="<?php echo ($row->prod_marca) ? $row->prod_marca : "" ?>"><br/>
            </div>
            <div class="col">
                <label>Qtde Estoque : </label> 
                 <input class="input-group-text btn-lg btn-block" type="text" name="qtde_estoque" id="qtde_estoque" value="<?php echo ($row->prod_qtde_estoque) ? $row->prod_qtde_estoque : 0 ?>"><br/>
            </div>
        </div>
        <div class="form-row">
            <div class="col">
                <label>Valor Total : </label> 
                <input class="input-group-text btn-lg btn-block" type="number" name="valor_total" id="valor_total" value="<?php echo ($row->prod_valor_total) ? $row->prod_valor_total : 0 ?>"><br/>
            </div>
            <!--div class="col">
                    <label>Possuí Promoção ? </label> 
                    <select class="input-group-text btn-lg btn-block" name="promocao">
                        <option value="0">Não</option>
                        <option value="1">SIM</option>
                    </select></br>
            </div>
            <div class="col">
                <label>Valor Promoção : </label> 
                <input class="input-group-text btn-lg btn-block" type="text" name="valor_promocao" id="valor_promocao" value="<?php echo ($row->prod_valor_promocao) ? $row->prod_valor_promocao : "" ?>"><br/>
            </div-->
            <div class="col">
            <label>Status : </label> 
                <select class="input-group-text btn-lg btn-block" name="status">
                    <option value="1" <?php echo $ativado ?>>Ativo</option>
                    <option value="0" <?php echo $desativado ?>>Desativado</option>
                </select>
            </div>
        </div>
        <label>Descrição : </label> 
         <input class="input-group-text btn-lg btn-block" type="text" name="descricao" id="descricao" value="<?php echo ($row->prod_descricao) ? $row->prod_descricao : "" ?>"><br/>
        <input style="background:#4fdc6f; color:white;" class="btn " type="submit" value="Atualizar Produto">
    </fieldset>
    </div>
</div>
</div>
</form>
</body>
<?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>
<a href="..\produtos\consultar_produtos.php"> Voltar</a>
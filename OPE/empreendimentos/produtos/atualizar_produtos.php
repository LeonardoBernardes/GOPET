<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-03 00:56:28
 */
include_once(dirname( __FILE__ ) .'\..\..\mysql_conexao\conexao_mysql.php');
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:index.php');
    }
 
$logado = $_SESSION['login'];
$prod_id = $_GET['id'];
$ativado = $desativado ='';

$sql="  SELECT 
            prod_id,
            prod_nome,
            prod_marca,
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
$endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/produtos/'.$endereco_img);
}

?>
<form method="post" action="update_produtos.php?id=<?= $prod_id ?>" id="formlogin" name="formlogin" enctype="multipart/form-data">
    <fieldset id="fie">
        <legend>Atualizar Produto</legend><br/>
        <label>Imagem : </label> 
        <img src="<?php echo $endereco_img ?>" style="width:400px; heigth:50px;" alt='Foto de exibição' /><br />
        <input type="file" name="imagem" id="imagem" > <br/>
        <label>Nome : </label> 
        <input type="text" name="nome" id="nome" value="<?php echo ($row->prod_nome) ? $row->prod_nome : "" ?>"><br/>
        <label>Marca : </label> 
        <input type="text" name="marca" id="marca" value="<?php echo ($row->prod_marca) ? $row->prod_marca : "" ?>"><br/>
        <label>Descrição : </label> 
        <input type="text" name="descricao" id="descricao" value="<?php echo ($row->prod_descricao) ? $row->prod_descricao : "" ?>"><br/>
        <label>Valor Total : </label> 
        <input type="number" name="valor_total" id="valor_total" value="<?php echo ($row->prod_valor_total) ? $row->prod_valor_total : 0 ?>"><br/>
        <label>Possuí Promoção ? </label> 
        <select name="promocao">
            <option value="0">Não</option>
            <option value="1">SIM</option>
        </select>
        <label>Valor Promoção : </label> 
        <input type="text" name="valor_promocao" id="valor_promocao" value="<?php echo ($row->prod_valor_promocao) ? $row->prod_valor_promocao : "" ?>"><br/>
        <label>Status : </label> 
        <select name="status">
            <option value="1" <?php echo $ativado ?>>Ativo</option>
            <option value="0" <?php echo $desativado ?>>Desativado</option>
        </select>
        <input type="submit" value="Atualizar Produto">
        
    </fieldset>
    
</form>
<a href="..\produtos\consultar_produtos.php"> Voltar</a>
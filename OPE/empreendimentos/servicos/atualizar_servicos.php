<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:49:32
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
$serv_id = $_GET['id'];

$sql="  SELECT 
            serv_id,
            serv_nome,
            serv_descricao,
            serv_valor_total,
            serv_promocao,
            serv_valor_promocao,
            serv_status
        FROM 
            `servicos` 
        WHERE 
            `serv_id` = '$serv_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);

?>
<form method="post" action="update_servicos.php?id=<?= $serv_id ?>" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Atualizar Serviço</legend><br/>
        <label>Nome : </label> 
        <input type="text" name="nome" id="nome" value="<?php echo ($row->serv_nome) ? $row->serv_nome : "" ?>"><br/>
        <label>Descrição : </label> 
        <input type="text" name="descricao" id="descricao" value="<?php echo ($row->serv_descricao) ? $row->serv_descricao : "" ?>"><br/>
        <label>Valor Total : </label> 
        <input type="number" name="valor_total" id="valor_total" value="<?php echo ($row->serv_valor_total) ? $row->serv_valor_total : 0 ?>"><br/>
        <label>Possuí Promoção ? </label> 
        <select name="promocao">
            <option value="0">Não</option>
            <option value="1">SIM</option>
        </select>
        <label>Valor Promoção : </label> 
        <input type="text" name="valor_promocao" id="valor_promocao" value="<?php echo ($row->serv_valor_promocao) ? $row->serv_valor_promocao : "" ?>"><br/>
        <label>Status : </label> 
        <select name="status">
            <option value="1">Ativo</option>
            <option value="0" selected>Desativado</option>
        </select>
        <input type="submit" value="Atualizar Serviço">
        
    </fieldset>
    
</form>
<a href="..\servicos\consultar_servicos.php"> Voltar</a>
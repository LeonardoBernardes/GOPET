<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-21 19:53:38
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
$even_id = $_GET['id'];

$sql="  SELECT 
            even_id,
            even_nome,
            even_descricao,
            even_data_realizacao,
            even_status
        FROM 
            `eventos` 
        WHERE 
            `even_id` = '$even_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);

?>
<form method="post" action="update_eventos.php?id=<?= $even_id ?>" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Atualizar Evento</legend><br/>
        <label>Nome : </label> 
        <input type="text" name="nome" id="nome" value="<?php echo ($row->even_nome) ? $row->even_nome : "" ?>"><br/>
        <label>Descrição : </label> 
        <input type="text" name="descricao" id="descricao" value="<?php echo ($row->even_descricao) ? $row->even_descricao : "" ?>"><br/>
        <label>Data Realização : </label> 
        <input type="text" name="data_realizacao" id="data_realizacao" value="<?php echo ($row->even_data_realizacao) ? $row->even_data_realizacao : "" ?>"><br/>
        <label>Status : </label> 
        <select name="status">
            <option value="1">Ativo</option>
            <option value="0" selected>Desativado</option>
        </select>
        <input type="submit" value="Atualizar Evento">
        
    </fieldset>
    
</form>
<a href="..\eventos\consultar_eventos.php"> Voltar</a>
<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-30 01:22:44
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




?>
<form method="post" action="cadastrar_produtos.php" id="formlogin" name="formlogin" enctype="multipart/form-data">
    <fieldset id="fie">
        <legend>Cadastrar Produto</legend><br/>
        <label>Imagem : </label> 
        <img src="" style="width:400px; heigth:50px;" alt='Foto de exibição' /><br />
        <input type="file" name="imagem" id="imagem" > <br/>
        <label>Nome : </label> 
        <input type="text" name="nome" id="nome"><br/>
        <label>Marca : </label> 
        <input type="text" name="marca" id="marca"><br/>
        <label>Descrição : </label> 
        <input type="text" name="descricao" id="descricao"><br/>
        <label>Valor Total : </label> 
        <input type="number" name="valor_total" id="valor_total"><br/>
        <label>Possuí Promoção ? </label> 
        <select name="promocao">
            <option value="0" selected>Não</option>
            <option value="1">SIM</option>
        </select>
        <label>Valor Promoção : </label> 
        <input type="text" name="valor_promocao" id="valor_promocao"><br/>
        <label>Status : </label> 
        <select name="status">
            <option value="1">Ativo</option>
            <option value="0" selected>Desativado</option>
        </select>
        <input type="submit" value="Cadastrar">
        
    </fieldset>
    
</form>
<a href="..\home_empreendimento.php"> Voltar</a>
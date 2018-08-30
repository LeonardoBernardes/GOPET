<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 18:49:34 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-14 21:52:20
 */

?>
<form method="post" action="cadastrar_login.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastrar-se</legend><br/>
        <label>LOGIN : </label> 
        <input type="text" name="login" id="login"><br/>
        <label>EMAIL : </label> 
        <input type="text" name="email" id="email"><br/>
        <label>TIPO DE USUÁRIO : </label>      
        <select name="tipo_usuario">
            <option value="1">ADMINISTRADOR</option>
            <option value="2">EMPREENDIMENTOS</option>
            <option value="3">USUÁRIOS</option>
            <option value="4">ADMINISTRADOR DE EMPREENDIMENTOS</option>
        </select> 
        <label>SENHA : </label> 
        <input type="password" name="senha" id="senha"><br/>
       
        <input type="submit" value="CADASTRAR">
    </fieldset>
</form>
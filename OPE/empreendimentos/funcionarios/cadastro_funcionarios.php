
<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-14 18:49:34 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-03 00:44:44
 */

?>
<form method="post" action="cadastrar_funcionarios.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
        <legend>Cadastrar Funcionário</legend><br/>
        <label>LOGIN : </label> 
        <input type="text" name="login_funcionario" id="login_funcionario"><br/>
        <label>EMAIL : </label> 
        <input type="text" name="email" id="email"><br/>
        <label>SENHA : </label> 
        <input type="password" name="senha" id="senha"><br/>
       
        <input type="submit" value="CADASTRAR">
    </fieldset>
</form>
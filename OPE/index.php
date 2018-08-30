<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-09 01:19:46 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-29 18:28:38
 */
?>

<form method="post" action="sessao.php" id="formlogin" name="formlogin" >
    <fieldset id="fie">
    
        <a href="cadastro_login.php">CADASTRAR-SE</a> 
        <legend>LOGIN</legend><br />
        <label>NOME : </label> 
        <input type="text" name="login" id="login"  /><br />
        <label>SENHA :</label>
        <input type="password" name="senha" id="senha" /><br />

        <input type="submit" value="LOGAR  "  />
    </fieldset>
</form>
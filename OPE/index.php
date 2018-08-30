<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-09 01:19:46 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-29 18:28:38
 */
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

    <form method="post" action="sessao.php" id="formlogin" name="formlogin" >
        <fieldset id="fie">
            <a href="cadastro_login.php">CADASTRAR-SE</a>
            <legend>LOGIN</legend><br />
            <label>NOME : </label>
            <input type="text" name="login" id="login"/><br/>
            <label>SENHA :</label>
            <input type="password" name="senha" id="senha"/><br />
            <input type="submit" value="LOGAR  "  />
        </fieldset>
    </form>

</body>
</html>
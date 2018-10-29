<?php
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:51:53
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
$logi_id = $_GET['id'];
$ativado = $desativado ='';

$sql="  SELECT 
            logi_id,
            logi_nome,
            logi_senha,
            logi_email,
            logi_status
        FROM 
            `login` 
        WHERE 
            `logi_id` = '$logi_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);

if($row->logi_status == 1){
    $ativado = "selected";
}else{
    $desativado = "selected";
}

    
include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php"; 
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
<form method="post" action="update_funcionarios.php?id=<?= $logi_id ?>" id="formlogin" name="formlogin" enctype="multipart/form-data">
    <fieldset id="fie">
        <legend>Atualizar Funcionários</legend><br/>
        <label>Login : </label> 
        <input class="input-group-text btn-lg btn-block" type="text" name="login_funcionario" id="login_funcionario" value="<?php echo ($row->logi_nome) ? $row->logi_nome : "" ?>"><br/>
        <label>Senha : </label> 
        <input class="input-group-text btn-lg btn-block" type="password" name="senha" id="senha" value="<?php echo ($row->logi_senha) ? $row->logi_senha : "" ?>"><br/>
        <label>Email : </label> 
        <input class="input-group-text btn-lg btn-block" type="text" name="email" id="email" value="<?php echo ($row->logi_email) ? $row->logi_email : "" ?>"><br/>
        <label>Status : </label> 
        <select class="input-group-text btn-lg btn-block" name="status">
            <option value="1" <?php echo $ativado ?>>Ativo</option>
            <option value="0" <?php echo $desativado ?>>Desativado</option>
        </select>
        <input class="btn btn-dark btn-lg btn-block" type="submit" value="Atualizar Funcionário">
        
    </fieldset>
    </div>
</div>
</div>
</form>
</body>
<?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>
<a href="..\funcionarios\consultar_funcionarios.php"> Voltar</a>
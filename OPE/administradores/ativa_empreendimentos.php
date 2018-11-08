<?php
include_once '../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 01:26:47 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-28 19:21:29
 */

    

    


include_once ROOT_PATH.'mysql_conexao/conexao_mysql.php';
session_start();

    if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['login']);
        unset($_SESSION['senha']);
        unset($_SESSION['grup_id']);
        header('location:'.$server_static.' index.php');
    }
 
$logado = $_SESSION['login'];
$login = $_SESSION['login'];
$senha = $_SESSION['senha'];
$status = $grupo = '';
$results = "";

$sql="  SELECT 
            logi_id,
            logi_nome,
            logi_email,
            logi_status,
            grup_id 
        FROM 
            `login` 
        WHERE 
            `logi_nome` <> '$login' 
            AND grup_id = 2
            OR grup_id = 4
            
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
while ($row = mysqli_fetch_object($result)) {

    if($row->logi_status == 0){
        $status = "DESATIVADO";
    }else{
        $status = "ATIVADO";
    }

    if($row->grup_id == 1){
        $grupo = "ADMINISTRATIVO";
    }elseif($row->grup_id == 2){
        $grupo = "EMPREENDIMENTOS";
    }elseif($row->grup_id == 3){
        $grupo = "USUÁRIOS";
    }elseif($row->grup_id == 4){
        $grupo = "ADMINISTRADOR DE EMPREENDIMENTOS";
    }


    $results .='<tr>
                    <td>'.$row->logi_id.'</td>
                    <td>'.$row->logi_nome.'</td>
                    <td>'.$row->logi_email.'</td>
                    <td>'.$status.'</td>
                    <td>'.$grupo.'</td>
                    <td><a href="'. $server_static.'administradores/atualizar_empreendimentos.php?id='.$row->logi_id.'"> Ativar ou Desativar</a></td>
                </tr>';
//echo $results;
}
 
include_once ROOT_PATH."menu_footer/menu_administrador.php" 
    
?>

<!DOCTYPE html>
<html>
    <head>
       <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo $server_static;?>static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="<?php echo $server_static;?>static/estilo.css">
    <title>Gopet</title>
       
<body>
<div class="main">
<table class="table tabelas" style="width:100%">
   <thead class="thead-dark">
    <tr>
        <th scope="col">ID</th>    
        <th scope="col">Nome Login</th>
        <th scope="col">Email</th> 
        <th scope="col">Status</th>
        <th scope="col">Grupo</th>
        <th scope="col">Editar</th>
    </tr>
    </thead>
    <?php echo $results ?>
</table>
<a class="btn btn-dark" href="<?php echo $server_static;?>administradores/home_administradores.php"> Voltar</a>
</div>
</body>
<?php 
include_once ROOT_PATH."menu_footer/footer.php" 
?>

</html>



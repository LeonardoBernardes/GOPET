<?php
include_once '../../config/server.php';
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:51:21
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
$serv_id = $_GET['id'];
$ativado = $desativado ='';

$sql="  SELECT 
            serv_id,
            serv_nome,
            serv_descricao,
            serv_valor_total,
            serv_promocao,
            serv_valor_promocao,
            serv_status,
            empr_id
        FROM 
            `servicos` 
        WHERE 
            `serv_id` = '$serv_id' 
        ";
//echo $sql;
//break;
$result =  mysqli_query($conn, $sql);
$row = mysqli_fetch_object($result);

if($row->serv_status == 1){
    $ativado = "selected";
}else{
    $desativado = "selected";
}

// Retorna imagem se possuir cadastrada
$sql3=" SELECT 
            seim_endereco
        FROM 
            servicos_imagens 
        WHERE 
            empr_id = $row->empr_id
            AND serv_id = $row->serv_id";
    //echo $sql3;
$result4 =  mysqli_query($conn, $sql3);
$row5 = mysqli_fetch_object($result4);

$endereco_img = '';
if(!empty($row5)){
    $endereco_img = $row5->seim_endereco;
}
if(!empty($endereco_img)){
//Criar Funcao para trazer local host como variavel
$endereco_img = str_replace('\\', '/',$server_static.'empreendimentos/servicos/'.$endereco_img);
}

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
<body id="formulario_empreendimento">
<?php include_once ROOT_PATH."menu_footer/menu_latera_empreendimento.php"; ?>
    <div class="main">

        <div class="container login-empreendimento">
                    <h2 style="background:#4fdc6f; color:white;" class="btn btn-sm btn-block">
                        <legend>Atualizar Serviços</legend>
                    </h2><br>
    <form method="post" action="update_servicos.php?id=<?= $serv_id ?>" id="formlogin" name="formlogin" enctype="multipart/form-data">
    <div class="card-group">
            <div id="cadastro_animal_card" class="card">
                    <label>Imagem: </label>
        <img class="card-img-top" src="<?php echo $endereco_img ?>" style="width:100px; heigth:50px;" alt='Foto de exibição' /><br />
        <input class="input-group-text btn-lg btn-block" type="file" name="imagem" id="imagem" > <br/>
        </div>
        <br>
        </div>
        <div class="form-row">
        <div class="col">
        <label>Nome : </label> 
        <input class="form-control form-control-sm" type="text" name="nome" id="nome" value="<?php echo ($row->serv_nome) ? $row->serv_nome : "" ?>"><br/>
        </div>
        <div class="col">
        <label>Valor Total : </label> 
        <input class="form-control form-control-sm" type="number" name="valor_total" id="valor_total" value="<?php echo ($row->serv_valor_total) ? $row->serv_valor_total : 0 ?>"><br/>
        </div>
        <div class="col">        
        <label>Possuí Promoção ? </label> 
        <select class="form-control form-control-sm" name="promocao">
            <option value="0">Não</option>
            <option value="1">SIM</option>
        </select>
        </div>
        </div>
        <div class="form-row">
        <div class="col">
        <label>Valor Promoção : </label> 
        <input class="form-control form-control-sm" type="text" name="valor_promocao" id="valor_promocao" value="<?php echo ($row->serv_valor_promocao) ? $row->serv_valor_promocao : "" ?>"><br/>
        </div>
        <div class="col">         
        <label>Status : </label> 
        <select class="form-control form-control-sm" name="status">
            <option value="1" <?php echo $ativado ?>>Ativo</option>
            <option value="0" <?php echo $desativado ?>>Desativado</option>
        </select>
        </div>
        </div>
        <label>Descrição : </label> 
        <input class="form-control form-control-sm" type="text" name="descricao" id="descricao" value="<?php echo ($row->serv_descricao) ? $row->serv_descricao : "" ?>"><br/>
        <input style="background:#4fdc6f; color:white;" class="btn " type="submit" value="Atualizar Serviço">
    </fieldset>
    </div>
</div>
</div>
    
</form>
</body>
<?php 
    include_once(ROOT_PATH."menu_footer/footer.php");     
    ?>
<a href="..\servicos\consultar_servicos.php"> Voltar</a>
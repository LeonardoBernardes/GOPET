<?php
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:39:29 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-14 19:50:44
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
$ativado = $desativado ='';

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

if($row->even_status == 1){
    $ativado = "selected";
}else{
    $desativado = "selected";
}

// Retorna imagem se possuir cadastrada
$sql3=" SELECT 
            evim_endereco
        FROM 
            eventos_imagens 
        WHERE 
            even_id = $row->even_id";
    //echo $sql3;
$result4 =  mysqli_query($conn, $sql3);
$row5 = mysqli_fetch_object($result4);

$endereco_img = '';
if(!empty($row5)){
    $endereco_img = $row5->evim_endereco;
}
if(!empty($endereco_img)){
//Criar Funcao para trazer local host como variavel
$endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/eventos/'.$endereco_img);
}

    
include_once "../../menu_footer/menu_latera_empreendimento.php";
include_once "../../menu_footer/menu_empreendimento.php";

?>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../static/estilo.css">
    
    
</head>
<body id="formulario_empreendimento">

    <div class="main">

        <div class="container login-empreendimento">
                    <h2 class="btn btn-dark btn-sm btn-block">
                        <legend>Atualizar Animal</legend>
                    </h2><br>
<form method="post" action="update_eventos.php?id=<?= $even_id ?>" id="formlogin" name="formlogin" enctype="multipart/form-data">
    <fieldset id="fie">
    <div class="card-group">
        <div id="cadastro_animal_card" class="card">
            <label>Imagem: </label>
            <img class="card-img-top" src="<?php echo $endereco_img; ?>" style="width:100px; heigth:50px;" alt='Foto de exibição' /><br />
            <input class="input-group-text btn-lg btn-block" type="file" name="imagem" id="imagem" > <br/>
        </div>
        </div>
        <br>
        <div class="form-row">
        <div class="col">
        <label>Nome </label>
        <input class="form-control form-control-sm" type="text" name="nome" id="nome" value="<?php echo ($row->even_nome) ? $row->even_nome : "" ?>"><br/>
        </div>
        <div class="col">
        <label>Data Realização : </label> 
        <input class="form-control form-control-sm" type="text" name="data_realizacao" id="data_realizacao" value="<?php echo ($row->even_data_realizacao) ? $row->even_data_realizacao : "" ?>"><br/>
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
        <input class="form-control form-control-sm" type="text" name="descricao" id="descricao" value="<?php echo ($row->even_descricao) ? $row->even_descricao : "" ?>"><br/>
        <input class="btn btn-dark btn-lg btn-block" type="submit" value="Atualizar Evento">
        
    </fieldset>
    </div>
</div>
</div>

</form>
</body>
<?php 
    include_once("../../menu_footer/footer.php");     
    ?>
<a href="..\eventos\consultar_eventos.php"> Voltar</a>
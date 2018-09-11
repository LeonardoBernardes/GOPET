<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-10 22:26:22
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
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    $status = '';
    $results = "";
    
    
if($grup_id == 3){

    //Recuperar id do usuario que quer cadastrar animal
    $sql2 = "SELECT
                usua_id
            FROM
                login_x_usuarios
            WHERE
                logi_id  = $logi_id   
            ";
    $result = mysqli_query($conn, $sql2);
    $id_usuario = mysqli_fetch_object($result);

    $sql3 = "SELECT
                anim_id,
                usan_flag
            FROM
                usuarios_x_animais 
            WHERE
                usua_id = $id_usuario->usua_id";
    $result = mysqli_query($conn, $sql3);
    while($row = mysqli_fetch_object($result)){

        if(!isset($ids)){
            $ids = $row->anim_id;
        }
        $ids = $ids.",".$row->anim_id;
    }
                        
}
    //Verificação do grupo de empreendimento
elseif($grup_id == 4 ||$grup_id == 2){
    
    //Pega o id do empreendimento que esse usuário está atrelado
    $sql2 = "SELECT
                empr_id
            FROM
                login_x_empreendimentos
            WHERE
                logi_id  = $logi_id   
        ";
    $result = mysqli_query($conn, $sql2);
    $id_empreendimento = mysqli_fetch_object($result);

    $sql3 ="SELECT
                anim_id,
                usan_flag
            FROM
                empreendimentos_x_animais 
            WHERE
                empr_id = $id_empreendimento->empr_id";
    $result = mysqli_query($conn, $sql3);
    while($row = mysqli_fetch_object($result)){

        if(!isset($ids)){
            $ids = $row->anim_id;
        }
        $ids = $ids.",".$row->anim_id;
    }
}  
    $sql="  SELECT 
                anim_id,
                anim_nome,
                anim_ra,
                anim_idade,
                anim_porte,
                anim_genero,
                anim_categoria,
                anim_restricao_doacao,
                anim_castracao
            FROM 
                `animais` 
            WHERE 
                `anim_id` in ($ids)
            ";
    //echo $sql;
    //break;
    $result =  mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_object($result)) {
        /*
        if($row->prod_status == 0){
            $status = "DESATIVADO";
        }else{
            $status = "ATIVADO";
        }*/
        $sql3=" SELECT 
                    anfo_endereco
                FROM 
                    animais_imagens 
                WHERE 
                    anim_id = $id_animal->anim_id";
        //echo $sql3;

        $result4 =  mysqli_query($conn, $sql3);
        $row5 = mysqli_fetch_object($result4);
    
    
        $endereco_img = '';
        if(!empty($row5)){
            $endereco_img = $row5->prim_endereco;
        }
        if(!empty($endereco_img)){
        //Criar Funcao para trazer local host como variavel
        $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/empreendimentos/produtos/'.$endereco_img);
        }
        
    
        $results .='<tr>
                        
                        <td>'.$row->prod_id.'</td>
                        <td><img src="'.$endereco_img.'"/></td>
                        <td>'.$row->anim_nome.'</td>
                        <td>'.$row->prod_marca.'</td>
                        <td>'.$row->prod_descricao.'</td>
                        <td>'.$row->prod_valor_total.'</td>
                        <td>'.$row->prod_promocao.'</td>
                        <td>'.$row->prod_valor_promocao.'</td>
                        <td>'.$status.'</td>
                        
                        <td><a href="..\produtos\atualizar_produtos.php?id='.$row->prod_id.'"> Editar</a></td>
                    </tr>';
    //echo $results;
    }
     include_once("../menu_footer/menu_empreendimento.php"); 
    ?>
    
<!DOCTYPE html>
<html>

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../static/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../static/estilo.css">

</head>

<body>

    <table class="table tabelas" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">imagem</th>
                <th scope="col">Nome</th>
                <th scope="col">Marca</th>
                <th scope="col">Descrição</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Possuí Promoção ?</th>
                <th scope="col">Valor Promoção</th>
                <th scope="col">Status</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <?php echo $results ?>
    </table>
    <a class="btn btn-dark" href="..\home_empreendimento.php"> Voltar</a>
</body>

<footer>

    <?php 
    include_once("../../menu_footer/footer.php");     
    ?>

</footer>

</html>
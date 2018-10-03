
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-20 19:48:02
 */
    include_once(dirname( __FILE__ ) .'\..\mysql_conexao\conexao_mysql.php');
    
    session_start();
    
        if((!isset ($_SESSION['login']) == true) and (!isset ($_SESSION['senha']) == true))
        {
            unset($_SESSION['login']);
            unset($_SESSION['senha']);
            unset($_SESSION['grup_id']);
            header('location:index.php');
        }
     
    //var_dump($_SESSION);
    $logado = $_SESSION['login'];
    $logi_id = $_SESSION['logi_id'];
    $grup_id = $_SESSION['grup_id'];
    
    $castracao = '';
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
                eman_flag
            FROM
                empreendimentos_x_animais 
            WHERE
                empr_id = $id_empreendimento->empr_id";
    //echo $sql3;
    $result = mysqli_query($conn, $sql3);

    while($row = mysqli_fetch_object($result)){
        if(!empty($row)){
            if(!isset($ids)){
                $ids = $row->anim_id;
            }
            $ids = $ids.",".$row->anim_id;
        }
    }
}  
    if(isset($ids)){
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
            
            if($row->anim_castracao == 0){
                $castracao = "Não";
            }elseif($row->anim_castracao == 1){
                $castracao = "Sim";
            }else{
                $castracao = "Não indentificado";
            }

            $sql3=" SELECT 
                        anim_id,
                        anfo_endereco
                    FROM 
                        animais_fotos 
                    WHERE 
                        anim_id in ($ids)";
            //echo $sql3;

            $result4 =  mysqli_query($conn, $sql3);
            $row5 = mysqli_fetch_object($result4);
        
        
            $endereco_img = '';
            if(!empty($row5)){

                if($row5->anim_id == $row->anim_id){
                    $endereco_img = $row5->anfo_endereco;
                }
            }
            if(!empty($endereco_img)){
            //Criar Funcao para trazer local host como variavel
            $endereco_img = str_replace('\\', '/',"http://localhost/".'PHP/GOPET/OPE/animais/'.$endereco_img);
            }
            
        
            $results .='<tr>
                            
                            <td>'.$row->anim_id.'</td>
                            <td><img style="width:200px;" src="'.$endereco_img.'"/></td>
                            <td>'.$row->anim_nome.'</td>
                            <td>'.$row->anim_ra.'</td>
                            <td>'.$row->anim_idade.'</td>
                            <td>'.$row->anim_porte.'</td>
                            <td>'.$row->anim_genero.'</td>
                            <td>'.$row->anim_categoria.'</td>
                            <td>'.$row->anim_restricao_doacao.'</td>
                            <td>'.$castracao.'</td>
                        
                            
                            <td><a href="http://localhost/PHP/GOPET/OPE/animais/atualizar_animais.php?id='.$row->anim_id.'"> Editar</a></td>
                        </tr>';
        //echo $results;
        }
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
<?php
if ($_SESSION['grup_id'] == 4){
    include_once("../menu_footer/menu_empreendimento.php"); 
    include_once("../menu_footer/menu_latera_empreendimento.php");
}
if ($_SESSION['grup_id'] == 1){    
    include_once("../menu_footer/menu_administrador.php");
}
if ($_SESSION['grup_id'] == 3){    
    include_once("../menu_footer/menu_usuario.php");
    include_once("../menu_footer/menu_latera_usuario.php");
}
?>
    <div class="main">
    <h2 style="margin-top:10%;">
        <legend><b>Meus Animais</b></legend>
    </h2><br>
    <a class="btn btn-success" href="http://localhost/PHP/GOPET/OPE/animais/cadastro_animais.php">Cadastrar Animais</a>
    <table class="table tabelas" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">imagem</th>
                <th scope="col">Nome</th>
                <th scope="col">RA</th>
                <th scope="col">Idade</th>
                <th scope="col">Porte</th>
                <th scope="col">Genero</th>
                <th scope="col">Categoria</th>
                <th scope="col">Restrição de adoção</th>
                <th scope="col">Castração</th>
                <th scope="col">Editar</th>
            </tr>
        </thead>
        <?php echo $results ?>
    </table>
    <?php
    if ($_SESSION['grup_id'] == 4){
        ?>
        <a class="btn btn-dark" href="..\empreendimentos\home_empreendimento.php"> Voltar</a>
    <?php
    }
    if ($_SESSION['grup_id'] == 3){    
    ?>
       <a class="btn btn-dark" href="..\usuarios\home_usuarios.php"> Voltar</a>
    <?php
    }
    ?>
   
        
    </div>
</body>

<footer>

    <?php 
    include_once("../menu_footer/footer.php");     
    ?>

</footer>

</html>
<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-09-04 19:14:28 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-10 20:43:28
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
    
    
    
    //Pega o id do empreendimento que esse usuário está atrelado
    $sql2 = "SELECT
                empr_id
            FROM
                login_x_empreendimentos
            WHERE
                logi_id  = $logi_id   
        ";
    $result = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_object($result);
    
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
                `empr_id` = '$row2->empr_id' 
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
                    produtos_imagens 
                WHERE 
                    empr_id = $row2->empr_id
                    AND prod_id = $row->prod_id";
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
     
    ?>
    
    <!DOCTYPE html>
    <html>
        <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="../../static/bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../../static/estilo.css">
        <title>Gopet</title>
           
            <style>
                table, th, td {
                    border: 1px solid black;
                    border-collapse: collapse;
                }
                th, td {
                    padding: 5px;
                }
                th {
                    text-align: left;
                }
            </style>
        </head>
    <body>
    
    <table class="table" style="width:100%">
       <thead class="thead-dark">
        <tr>
            <th scope="col">ID</th>  
            <th scope="col" >imagem</th>   
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
    </html>
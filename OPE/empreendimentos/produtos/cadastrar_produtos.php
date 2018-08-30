<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-08-30 01:32:45
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
    
$foto = $_FILES["imagem"];  
$logado = $_SESSION['login'];
$logi_id = $_SESSION['logi_id'];

$prod_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$prod_marca = ($_POST['marca']) ? $_POST['marca'] : "";
$prod_descricao = ($_POST['descricao']) ? $_POST['descricao'] : "";
$prod_valor_total = ($_POST['valor_total']) ? $_POST['valor_total'] : "";
$prod_promocao = ($_POST['promocao']) ? $_POST['promocao'] : 0;
$prod_valor_promocao = ($_POST['valor_promocao']) ? $_POST['valor_promocao'] : 0;
$prod_status = ($_POST['status']) ? $_POST['status'] : 0;



//$empr_status = $_POST['status'] ? : "";

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

//Insere o produto
$sql3 = "   INSERT INTO 
                produtos 
                    (
                        empr_id,
                        prod_nome,
                        prod_marca,
                        prod_descricao,
                        prod_valor_total,
                        prod_promocao,
                        prod_valor_promocao,
                        prod_status,
                        prod_data_cadastro    
                    )
            VALUES 
                    (
                        $row2->empr_id,
                        '$prod_nome',
                        '$prod_marca',
                        '$prod_descricao',
                        $prod_valor_total,
                        $prod_promocao,
                        $prod_valor_promocao,
                        $prod_status,
                        '1998-11-20'
                    )";
//echo $sql3;
$c2 = mysqli_query($conn, $sql3);


$query= " SELECT empr_id,MAX(prod_id) prod_id from produtos where empr_id = $row2->empr_id";
//echo $query;
$result = mysqli_query($conn, $query);
$row3 = mysqli_fetch_object($result);



// Se a foto estiver sido selecionada
if (!empty($foto["name"])) {
            
    //   Controle de tamanho de imagens
        // Largura máxima em pixels
        $largura = 3000;
        // Altura máxima em pixels
        $altura = 3000;
        // Tamanho máximo do arquivo em bytes
        $tamanho = 45000;
    
        $error = array();
    
        // Verifica se o arquivo é uma imagem
        if(!preg_match("/^image\/(pjpeg|jpeg|png|gif|bmp)$/", $foto["type"])){
            $error[1] = "Isso não é uma imagem.";
            } 
    
        // Pega as dimensões da imagem
        $dimensoes = getimagesize($foto["tmp_name"]);
    
        // Verifica se a largura da imagem é maior que a largura permitida
        if($dimensoes[0] > $largura) {
            $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
        }
    
        // Verifica se a altura da imagem é maior que a altura permitida
        if($dimensoes[1] > $altura) {
            $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
        }
        
        // Verifica se o tamanho da imagem é maior que o tamanho permitido
        if($foto["size"] > $tamanho) {
                $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
        }
    
        // Se não houver nenhum erro
        if (count($error) == 0) {
        
            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
    
            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
    
            // Caminho de onde ficará a imagem
            $caminho_imagem = "produtos_imagens/" . $nome_imagem;
    
            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        
            $sql_verifica ="SELECT
                                prim_id
                            FROM 
                                produtos_imagens
                            WHERE
                                empr_id = $row3->empr_id
                                AND prod_id = $row3->prod_id
                            ";
            $v = mysqli_query($conn, $sql_verifica);
            $row4 = mysqli_fetch_object($v);
            if(empty($row4)){
            // Insere os dados no banco
                $sql = "INSERT INTO 
                            produtos_imagens
                                (
                                    prim_endereco, 
                                    prim_data_cadastro, 
                                    empr_id,
                                    prod_id
                                ) 
                            VALUES 
                                (
                                    '".$caminho_imagem."', 
                                    '2018-08-28',
                                    $row3->empr_id,
                                    $row3->prod_id
                                )
                        ";
               
                $c3 = mysqli_query($conn, $sql);
            }else{
                $sql = "    UPDATE 
                                produtos_imagens 
                            SET 
                                prim_endereco = '".$caminho_imagem."', 
                                prim_data_atualizacao = '2018-08-28' 
                            WHERE 
                                empr_id = $row3->empr_id
                                AND prod_id = $row3->prod_id
                        ";
           
                $c3 = mysqli_query($conn, $sql);
            }
        }
    
        // Se houver mensagens de erro, exibe-as
        if (count($error) != 0) {
            foreach ($error as $erro) {
                echo $erro . "<br />";
            }
        }
    }



header('location:..\produtos\consultar_produtos.php');

?>
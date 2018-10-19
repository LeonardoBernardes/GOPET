<?php 
/*
 * @Author: Leonardo.Bernardes 
 * @Date: 2018-08-15 19:51:19 
 * @Last Modified by: Leonardo.Bernardes
 * @Last Modified time: 2018-09-04 01:20:54
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
$foto = $_FILES["imagem"];
$serv_id = $_GET['id'];

$serv_nome = ($_POST['nome']) ? $_POST['nome'] : "";
$serv_descricao = ($_POST['descricao']) ? $_POST['descricao'] : "";
$serv_valor_total = ($_POST['valor_total']) ? $_POST['valor_total'] : "";
$serv_promocao = ($_POST['promocao']) ? $_POST['promocao'] : 0;
$serv_valor_promocao = ($_POST['valor_promocao']) ? $_POST['valor_promocao'] : 0;
$serv_status = ($_POST['status']) ? $_POST['status'] : 0;

$sql="  SELECT 
            serv_id,
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


$sql ="  UPDATE 
            servicos
        SET 
            serv_nome = '$serv_nome',
            serv_descricao = '$serv_descricao',
            serv_valor_total = $serv_valor_total,
            serv_promocao = $serv_promocao,
            serv_valor_promocao = $serv_valor_promocao,
            serv_status = $serv_status,
            serv_data_atualizacao = NOW()
        WHERE 
            serv_id = $serv_id
        ";

$result =  mysqli_query($conn, $sql);


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
        /*if($dimensoes[0] > $largura) {
            $error[2] = "A largura da imagem não deve ultrapassar ".$largura." pixels";
        }
    
        // Verifica se a altura da imagem é maior que a altura permitida
        if($dimensoes[1] > $altura) {
            $error[3] = "Altura da imagem não deve ultrapassar ".$altura." pixels";
        }
        
        // Verifica se o tamanho da imagem é maior que o tamanho permitido
        if($foto["size"] > $tamanho) {
                $error[4] = "A imagem deve ter no máximo ".$tamanho." bytes";
        }*/
    
        // Se não houver nenhum erro
        if (count($error) == 0) {
        
            // Pega extensão da imagem
            preg_match("/\.(gif|bmp|png|jpg|jpeg){1}$/i", $foto["name"], $ext);
    
            // Gera um nome único para a imagem
            $nome_imagem = md5(uniqid(time())) . "." . $ext[1];
    
            // Caminho de onde ficará a imagem
            $caminho_imagem = "servicos_imagens/" . $nome_imagem;
    
            // Faz o upload da imagem para seu respectivo caminho
            move_uploaded_file($foto["tmp_name"], $caminho_imagem);
        
            $sql_verifica ="SELECT
                                seim_id,
                                empr_id
                            FROM 
                                servicos_imagens
                            WHERE
                                serv_id = $serv_id
                            ";
            $v = mysqli_query($conn, $sql_verifica);
            $row4 = mysqli_fetch_object($v);
            if(empty($row4)){
            // Insere os dados no banco
                $sql = "INSERT INTO 
                            servicos_imagens
                                (
                                    seim_endereco, 
                                    seim_data_cadastro, 
                                    empr_id,
                                    serv_id
                                ) 
                            VALUES 
                                (
                                    '".$caminho_imagem."', 
                                    NOW(),
                                    $row->empr_id,
                                    $row->serv_id
                                )
                        ";
               
                $c3 = mysqli_query($conn, $sql);
            }else{
                $sql = "    UPDATE 
                                servicos_imagens 
                            SET 
                                seim_endereco = '".$caminho_imagem."', 
                                seim_data_atualizacao = NOW() 
                            WHERE 
                                empr_id = $row->empr_id
                                AND serv_id = $row->serv_id
                        ";
          // echo $sql;
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




header('location:..\servicos\consultar_servicos.php');
//echo $prod_id;


?>